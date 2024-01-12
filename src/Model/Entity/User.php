<?php
declare(strict_types=1);

namespace App\Model\Entity;
use Cake\ORM\SoftDeleteTrait;
// use Cake\ORM\Behavior\SoftDeleteBehavior;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property int $contact_number
 * @property string $email
 * @property string $password
 * @property string $confirm_password
 * @property string $address
 * @property int $state
 * @property string $is_admin
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    // use SoftDeleteTrait;
    // use SoftDeleteBehavior;
    protected $_accessible = [
        'first_name' => true,
        'last_name' => true,
        'contact_number' => true,
        'email' => true,
        'password' => true,
        'confirm_password' => true,
        'address' => true,
        'state' => true,
        'is_admin' => true,
        'created' => true,
        'modified' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
    ];

}
