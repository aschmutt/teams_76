<?php
namespace Teams\Teams\Controller;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * TeamsController
 */
class TeamsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * teamsRepository
     *
     * @var \Teams\Teams\Domain\Repository\TeamsRepository
     * @inject
     */
    protected $teamsRepository = NULL;
    
    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $teams = $this->teamsRepository->findAll();
        $this->view->assign('teamss', $teams);
    }
    
    /**
     * action show
     *
     * @param \Teams\Teams\Domain\Model\Teams $teams
     * @return void
     */
    public function showAction(\Teams\Teams\Domain\Model\Teams $teams)
    {
        $this->view->assign('teams', $teams);
    }
    
    /**
     * action new
     *
     * @return void
     */
    public function newAction()
    {
        
    }
    
    /**
     * action create
     *
     * @param \Teams\Teams\Domain\Model\Teams $newTeams
     * @return void
     */
    public function createAction(\Teams\Teams\Domain\Model\Teams $newTeams)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->teamsRepository->add($newTeams);
        $this->redirect('list');
    }
    
    /**
     * action edit
     *
     * @param \Teams\Teams\Domain\Model\Teams $teams
     * @ignorevalidation $teams
     * @return void
     */
    public function editAction(\Teams\Teams\Domain\Model\Teams $teams)
    {
        $this->view->assign('teams', $teams);
    }
    
    /**
     * action update
     *
     * @param \Teams\Teams\Domain\Model\Teams $teams
     * @return void
     */
    public function updateAction(\Teams\Teams\Domain\Model\Teams $teams)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->teamsRepository->update($teams);
        $this->redirect('list');
    }
    
    /**
     * action delete
     *
     * @param \Teams\Teams\Domain\Model\Teams $teams
     * @return void
     */
    public function deleteAction(\Teams\Teams\Domain\Model\Teams $teams)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->teamsRepository->remove($teams);
        $this->redirect('list');
    }

}