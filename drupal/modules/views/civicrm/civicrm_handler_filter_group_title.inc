<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 3.1                                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
*/

/*
 * Heavily based on anonymous code contribution. No claim.
 * CiviCRM Views Integration
 *
 * civicrm_handler_filter_contribution_type.inc
 * Filters Contribution Types, and is configured using the labels from the database
 *
 */

class civicrm_handler_filter_group_title extends views_handler_filter_in_operator {
    static $_groupName;

    function construct( ) {
        parent::construct();
        if ( ! self::$_groupName ) {
            if ( ! civicrm_initialize( ) ) {
                return;
            }
            require_once 'CRM/Core/PseudoConstant.php';
            self::$_groupName = CRM_Core_PseudoConstant::allGroup( );
        }
    }

    function get_value_options() {
        if (!isset($this->value_options)) {
            $this->value_title = t('Group Name');
            $options = array( );
            foreach (self::$_groupName as $id => $name ) {
                $options[$name] = $name;
            }
            $this->value_options = $options;
        }
    }

}
?>
