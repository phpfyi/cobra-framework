<?php

namespace Cobra\Auth\User;

use Cobra\Auth\Group\Group;
use Cobra\Auth\Password\Password;
use Cobra\Auth\Password\PasswordValidationHtmlElement;
use Cobra\Cms\Traits\ModelDataTableColumns;
use Cobra\Form\Field\CountrySelectField;
use Cobra\Form\Field\EmailField;
use Cobra\Form\Field\PasswordField;
use Cobra\Form\Field\SelectField;
use Cobra\Html\HtmlElement;
use Cobra\Interfaces\Auth\Password\PasswordEncrypterInterface;
use Cobra\Interfaces\Auth\User\UserInterface;
use Cobra\Interfaces\Controller\ControllerInterface;
use Cobra\Interfaces\Form\FormInterface;
use Cobra\Model\Model;
use Cobra\Model\ModelDatabaseTable;
use Cobra\Page\Model\PageComment;
use Cobra\Page\Model\PageRating;

/**
 * User Model
 *
 * Model representing a CMS user.
 *
 * There are numerous fields on the User model to allow detailed information
 * about the User to be stored such as name, gender, location etc which can
 * be used to customise the user experience, preferences, and page content.
 *
 * The User model comes with some default relations such as comments and social
 * links which can be displayed across your application and enhance page
 * functionaliy.
 *
 * Sub classing the user model is the best way to expand functionality.
 *
 * For security reasons modifying the underlying default user fields is highly
 * discouraged as they are heavily tied into the default authentication system.
 *
 * The current logged in User model can be retrived via:
 * @method auth()->getUser()
 *
 * Use in conjuncation with the Group Model to restrict access to the CMS and
 * other areas of your application.
 *
 * The current User model is used across the CMS as a means of identification
 * and authentication and is populated on each request based on the logged in
 * User identifier.
 *
 * The Session authenticator is used as the default way of identiying a user,
 * @see Cobra\Auth\Middleware\AuthenticatedUserMiddleware
 *
 * The User model contains various hashed tokens and values which deal with
 * identifying and validating the logged in user status such as:
 *
 * @property int $account
 * A User has one account status such as "active", "pending", "disabled" which
 * can be also be used to restrict actions and access across the CMS or
 * website application.
 *
 * @property string $active_token
 * The primary means of identifying a user based off the session authenticator
 *
 * @property string $login_expiry
 * The expiry time of the current logged in user session
 * Can be changed across environments.
 * Defaults to +1 hour.
 * @see CMS_LOGIN_EXPIRY in environment.yml
 *
 * @property string $device_id
 * A generated hash used to identify the current user device and prevent signing
 * in from multiple devices simultaneously.
 * Can be turned off through the config system.
 * @see auth.single_device_signin
 *
 * @property string $reset_token
 * The token used to identify the user when requesitng a password reset
 *
 * @property string $confirm_token
 * The token used to confirm a user account once registered.
 *
 * User actions such as logging in are recorded in UserLog records.
 * Custom events can be added throughout the application to expand on the User
 * logging behaviour for more advanced reporting.
 * @see Event subclasses
 *
 * A User password is stored in the database in an unreadable hashed value and
 * does not render in the CMS interface.
 *
 * @category  Auth
 * @package   Cobra
 * @author    Andrew Mc Cormack <webmaster@ddmseo.com>
 * @copyright Copyright (c) 2019, Andrew Mc Cormack
 * @license   https://github.com/phpfyi/cobra-framework/issues
 * @version   1.0.0
 * @link      https://github.com/phpfyi/cobra-framework
 * @since     1.0.0
 */
class User extends Model implements UserInterface
{
    use ModelDataTableColumns;

    /**
     * Model table name
     *
     * @var string
     */
    protected $table = 'User';

    /**
     * Model singular name
     *
     * @var string
     */
    protected $singular = 'User';

    /**
     * Model plural name
     *
     * @var string
     */
    protected $plural = 'Users';

    /**
     * Model icon path
     *
     * @var string
     */
    protected $icon = 'user';

    /**
     * Model database schema fields
     *
     * @param  ModelDatabaseTable $schema
     * @return ModelDatabaseTable
     */
    public function databaseTable(ModelDatabaseTable $schema): ModelDatabaseTable
    {
        // fields
        $schema->primary();
        $schema->created();
        $schema->updated();
        $schema->varchar('forename');
        $schema->varchar('surname');
        $schema->varchar('email');
        $schema->varchar('gender');
        $schema->date('dob');
        $schema->varchar('town');
        $schema->varchar('county');
        $schema->varchar('country');
        $schema->varchar('occupation');
        $schema->varchar('company');
        $schema->boolean('mailing');
        $schema->varchar('username');
        $schema->varchar('password');
        $schema->int('account');
        $schema->varchar('active_token');
        $schema->created('login_expiry');
        $schema->varchar('device_id');
        $schema->varchar('reset_token');
        $schema->varchar('confirm_token');
        $schema->varchar('ip_address');
        // has many
        $schema->hasMany('Comments', PageComment::class);
        $schema->hasMany('Ratings', PageRating::class);
        $schema->hasMany('Passwords', Password::class);
        $schema->hasMany('Logs', UserLog::class);
        // many many
        $schema->belongsManyMany('Groups', Group::class);

        return $schema;
    }

    /**
     * Model CMS form fields override
     *
     * @param  FormInterface $form
     * @return FormInterface
     */
    public function cmsForm(FormInterface $form): FormInterface
    {
        // update field types
        $form->setField(EmailField::resolve('email'));
        $form->setField(PasswordField::resolve('password')->addClass('password-field'));
        $form->insertAfter('password', PasswordField::resolve('password_confirm')->addClass('password-field'));
        $form->insertAfter('password_confirm', PasswordValidationHtmlElement::resolve('password_validator'));

        // select fields
        $form->setField(SelectField::resolve('gender')
            ->setData(array_combine_from(static::config('gender_options'))));
        $form->setField(SelectField::resolve('account')
            ->setData(static::config('status_options')));
        $form->setField(CountrySelectField::resolve('country'));

        // remove token fields
        $form->removeFields(['reset_token', 'confirm_token']);

        // readonly
        $form->setReadonly(['ip_address', 'login_expiry', 'device_id']);
        $form->getField('username')->setDescription('Allowed characters: A-Z a-z 0-9 _-');

        // headings
        $form->insertBefore('town', HtmlElement::resolve('h4', 's1', 'Location'));
        $form->insertBefore('occupation', HtmlElement::resolve('h4', 's2', 'Role'));
        $form->insertBefore('mailing', HtmlElement::resolve('h4', 's4', 'Subscriptions'));
        $form->insertBefore('username', HtmlElement::resolve('h4', 's5', 'Account'));

        // validation
        $form->setValidators(static::config('validation_rules'));
        if (container_object(ControllerInterface::class)->getUrlParser()->getAction() == 'create') {
            // requires setting a password on user creation
            $form->setValidators(static::config('password_validation_rules'));
        }
        return $form;
    }

    /**
     * Returns the model title text
     *
     * Used the user full name - first and last name
     *
     * @return string
     */
    public function title(): string
    {
        return sprintf('%s %s', $this->forename, $this->surname);
    }

    /**
     * Hook called before binding data.
     *
     * The password field is unset and set on a virtal property so as not to
     * show within the CMS record UI.
     *
     * Because the password is hashed when sent to the database, returning and
     * displaying it within the UI would:
     * 1. Not show the saved password but the hashed one.
     * 2. Present a security risk
     *
     * @return void
     */
    public function afterFetch(): void
    {
        $this->password_token = $this->password;
        $this->password = null;
    }

    /**
     * Hook called after fetching this record from database.
     *
     * If a new password has not been set when saving the record then the empty
     * password property is removed from the properties to save.
     *
     * @return void
     */
    public function beforeSave(): void
    {
        if (!$this->password) {
            unset($this->password);
        } else {
            $this->password = container_resolve(PasswordEncrypterInterface::class)::encrypt($this->password);
        }
    }
}
