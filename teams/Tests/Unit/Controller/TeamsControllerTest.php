<?php
namespace Teams\Teams\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Teams\Teams\Controller\TeamsController.
 *
 */
class TeamsControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \Teams\Teams\Controller\TeamsController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('Teams\\Teams\\Controller\\TeamsController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllTeamssFromRepositoryAndAssignsThemToView()
	{

		$allTeamss = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$teamsRepository = $this->getMock('Teams\\Teams\\Domain\\Repository\\TeamsRepository', array('findAll'), array(), '', FALSE);
		$teamsRepository->expects($this->once())->method('findAll')->will($this->returnValue($allTeamss));
		$this->inject($this->subject, 'teamsRepository', $teamsRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('teamss', $allTeamss);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenTeamsToView()
	{
		$teams = new \Teams\Teams\Domain\Model\Teams();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('teams', $teams);

		$this->subject->showAction($teams);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenTeamsToTeamsRepository()
	{
		$teams = new \Teams\Teams\Domain\Model\Teams();

		$teamsRepository = $this->getMock('Teams\\Teams\\Domain\\Repository\\TeamsRepository', array('add'), array(), '', FALSE);
		$teamsRepository->expects($this->once())->method('add')->with($teams);
		$this->inject($this->subject, 'teamsRepository', $teamsRepository);

		$this->subject->createAction($teams);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenTeamsToView()
	{
		$teams = new \Teams\Teams\Domain\Model\Teams();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('teams', $teams);

		$this->subject->editAction($teams);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenTeamsInTeamsRepository()
	{
		$teams = new \Teams\Teams\Domain\Model\Teams();

		$teamsRepository = $this->getMock('Teams\\Teams\\Domain\\Repository\\TeamsRepository', array('update'), array(), '', FALSE);
		$teamsRepository->expects($this->once())->method('update')->with($teams);
		$this->inject($this->subject, 'teamsRepository', $teamsRepository);

		$this->subject->updateAction($teams);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenTeamsFromTeamsRepository()
	{
		$teams = new \Teams\Teams\Domain\Model\Teams();

		$teamsRepository = $this->getMock('Teams\\Teams\\Domain\\Repository\\TeamsRepository', array('remove'), array(), '', FALSE);
		$teamsRepository->expects($this->once())->method('remove')->with($teams);
		$this->inject($this->subject, 'teamsRepository', $teamsRepository);

		$this->subject->deleteAction($teams);
	}
}
