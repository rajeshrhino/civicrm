<?php

/*
 +--------------------------------------------------------------------+
 | CiviCRM version 3.1                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2010                                |
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

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2010
 * $Id$
 *
 */

require_once 'CRM/Core/Controller.php';
require_once 'CRM/Core/Session.php';

/**
 * This class is used for item create functionality.
 *
 *  - the controller is used for building/processing multiform
 *    searches.
 *
 * Typically the first form will be used to create account if not already exists
 *
 * The second form is used to add items
 *
 */

class CRM_Auction_Controller_Item extends CRM_Core_Controller {

    /**
     * class constructor
     */
    function __construct( $title = null, $action = CRM_Core_Action::NONE, $modal = true ) {
        require_once 'CRM/Auction/StateMachine/Item.php';
        parent::__construct( $title, $modal );
        
        $this->_stateMachine =& new CRM_Auction_StateMachine_Item( $this, $action );

        // create and instantiate the pages
        $this->addPages( $this->_stateMachine, $action );

        // add all the actions
        $uploadNames = $this->get( 'uploadNames' );
        if ( ! empty( $uploadNames ) ) {
            $config =& CRM_Core_Config::singleton( );
            $this->addActions( $config->customFileUploadDir, $uploadNames );
        } else {
            $this->addActions( );
        }
    }

}
