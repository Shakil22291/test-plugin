<?php

namespace Inc;

class UserBirthDay
{
    public function __construct()
    {
        // Add the field to user's own profile editing screen
        add_action(
            'show_user_profile',
            [$this, 'field']
        );
        // Add the field to user's editing screen
        add_action(
            'edit_user_profile',
            [$this, 'field']
        );

        // add the save action to user's own profie editing screen update
        add_action(
            'personal_options_update',
            [$this, 'save']
        );

        // add the save action to user's profie editing screen update
        add_action(
            'edit_user_profile_update',
            [$this, 'save']
        );
    }

    /**
     * The Save action
     *
     * @param int $user_id the ID of the current user
     *
     * @return bool|int Meta ID if the key didn't exist, true on successfull update, false on failiure
     */
    public function save($user_id)
    {
        // check the current user has the capability to edit the $user_id
        if ( ! current_user_can('edit_user', $user_id) ) {
            return false;
        };

        // create/update user meta for $user_id
        update_user_meta(
            $user_id,
            'birthday',
            $_POST['birthday']
        );

    }

    /**
     * The field on the editing screen
     *
     * @param $user \WP_User user object
     */
    public function field(\WP_User $user)
    {
        ?>
            <h2>It's Your Birthday</h2>
            <table class="form-table">
                <tr>
                    <th>
                        <label for="birthday">Birthday</label>
                    </th>
                    <td>
                        <input
                            type="date"
                            id="birthday"
                            name="birthday"
                            value="<?= esc_attr(get_user_meta($user->ID, 'birthday', true)); ?>"
                            title="Please use the YYYY-MM-DD format"
                            pattern="(19[0-9][0-9]|20[0-9][0-9])-(1[0-2]|0[1-9])-(3[01]|[21][0-9]|0[1-9])"
                        >
                    </td>
                </tr>
            </table>
        <?php
    }

}