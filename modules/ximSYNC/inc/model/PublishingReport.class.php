<?php
/******************************************************************************
 *  Ximdex a Semantic Content Management System (CMS)    							*
 *  Copyright (C) 2011  Open Ximdex Evolution SL <dev@ximdex.org>	      *
 *                                                                            *
 *  This program is free software: you can redistribute it and/or modify      *
 *  it under the terms of the GNU Affero General Public License as published  *
 *  by the Free Software Foundation, either version 3 of the License, or      *
 *  (at your option) any later version.                                       *
 *                                                                            *
 *  This program is distributed in the hope that it will be useful,           *
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of            *
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             *
 *  GNU Affero General Public License for more details.                       *
 *                                                                            *
 * See the Affero GNU General Public License for more details.                *
 * You should have received a copy of the Affero GNU General Public License   *
 * version 3 along with Ximdex (see LICENSE).                                 *
 * If not, see <http://gnu.org/licenses/agpl-3.0.html>.                       *
 *                                                                            *
 * @version $Revision:$                                                       *
 *                                                                            *
 *                                                                            *
 ******************************************************************************/



 ModulesManager::file('/inc/model/orm/PublishingReport_ORM.class.php', 'ximSYNC');

/**
*	@brief CRUD for Publishing Reports data.
*
*	This class includes the methods that interact with the Database.
*/

class PublishingReport extends PublishingReport_ORM {

	/**
	*  Adds a row to PublishingReport table.
	*  @param int idSection
	*  @param int idNode
	*  @param int idChannel
	*  @param int idSyncServer
	*  @param int idPortalVersion
	*  @param int pubTime
	*  @param string state
	*  @param string progress
	*  @param string fileName
	*  @param string filePath
	*/

	public $progressTable = array(
		'Pending' => '20',
		'Due2In_' => '40',
		'Due2In' => '60',
		'Due2Out_' => '40',
		'Due2Out' => '60',
		'Pumped' => '80',
		'In' => '100',
		'Out' => '100',
		'Canceled' => '100',
		'Replaced' => '100',
		'Removed' => '100'
	);

	function create($idSection, $idNode, $idChannel, $idSyncServer, $idPortalVersion
					, $pubTime, $state, $progress, $fileName, $filePath, $idSync, $idBatch, $idParentServer) {

		if($idSection != null && $idNode !=null) {
			$dbObj = new DB();
			$sql = "SELECT * " .
					"FROM PublishingReport " .
					"WHERE IdSection = " . $idSection . " AND IdNode = " . $idNode . " " .
					"LIMIT 1";
			$dbObj->Query($sql);
			if(!$dbObj->EOF) {
				$updateFields = array(
					'IdChannel' => $idChannel,
					'IdSyncServer' => $idSyncServer,
					'IdPortalVersion' => $idPortalVersion,
					'State' => $state,
					'Progress' => $progress,
					'FileName' => $fileName,
					'FilePath' => $filePath,
					'IdSync' => $idSync,
					'IdBatch' => $idBatch,
					'IdParentServer' => $idParentServer,
				);
				$searchFields = array(
					'IdSection' => $idSection,
					'IdNode' => $idNode
				);
				$this->updateReportByField($updateFields, $searchFields, true);
				return null;
			}
		}

		$this->set('IdReport', null);
		$this->set('IdSection', $idSection);
		$this->set('IdNode', $idNode);
		$this->set('IdChannel', $idChannel);
		$this->set('IdSyncServer', $idSyncServer);
		$this->set('IdPortalVersion', $idPortalVersion);
		$this->set('PubTime', time());
		$this->set('State', $state);
		$this->set('Progress', $progress);
		$this->set('FileName', $fileName);
		$this->set('FilePath', $filePath);
		$this->set('IdSync', $idSync);
		$this->set('IdParentServer', $idParentServer);
		$this->set('IdBatch', $idBatch);

		parent::add();

		return null;
    }

	/**
	*  Gets the rows from PublishingReport table which match the values of a list of fields.
	*  @param array arrayFields
	*  @return array|null
	*/

    function updateReportByField($updateFields, $searchFields, $fromCreate = false) {

    	$whereClause = " WHERE TRUE";
		if (is_array($searchFields) && count($searchFields) >= 0) {
			foreach  ($searchFields as $fieldName => $fieldValue) {
				if ($this->isField($fieldName)) {
					$whereClause .= " AND " . $fieldName . " = '" . $fieldValue . "'";
				}
			}
		}

		$setClause = " ";
    	if (is_array($updateFields) && count($updateFields) >= 0) {
			$setClause .= ($fromCreate === false) ? "SET PubTime = PubTime" : "SET PubTime = " . time();
    		foreach  ($updateFields as $fieldName => $fieldValue) {
				if ($this->isField($fieldName)) {
					$setClause .= "," . $fieldName . " = '" . $fieldValue . "' ";
				}
			}
		}

		$query = "UPDATE PublishingReport" . $setClause . $whereClause;
		$dbObj = new DB();
		$dbObj->execute($query);

		return null;
    }

    function getReportByIdNode($idNodeGenerator = null) {

    	$nodeNames = array();

    	$frames = array();
		$extraWhereClause = ($idNodeGenerator !== null) ? "AND IdParentServer = '" . $idNodeGenerator . "' " : "";

		$dbObj = new DB();
		$sql = "SELECT * " .
				"FROM PublishingReport " .
				"WHERE State NOT IN ('Replaced', 'Removed') " .
				$extraWhereClause . "ORDER BY IdPortalVersion DESC, FilePath ASC, FileName ASC LIMIT 100";
		$dbObj->Query($sql);

		while (!$dbObj->EOF) {
			$frame = array();
			$batchStates = array();
			if(!array_key_exists($dbObj->GetValue("IdSection"), $nodeNames)) {
				$sectionNode = new Node($dbObj->GetValue("IdSection"));
				$nodeNames[$dbObj->GetValue("IdSection")] = $sectionNode->get('Name');
			}
			if(!array_key_exists($dbObj->GetValue("IdBatch"), $batchStates)) {
				$batch = new Batch($dbObj->GetValue("IdBatch"));
				$batchStates[$dbObj->GetValue("IdBatch")] = ($batch->get('Playing') == 1) ? 'activa' : 'detenida';
			}
			$frame["IdNodeGenerator"] = $dbObj->GetValue("IdSection");
			$frame["NodeName"] = $nodeNames[$dbObj->GetValue("IdSection")];
			$frame["IdNode"] = $dbObj->GetValue("IdNode");
			$frame["IdChannel"] = $dbObj->GetValue("IdChannel");
			$frame["IdSyncServer"] = $dbObj->GetValue("IdSyncServer");
			$frame["IdPortalVersion"] = $dbObj->GetValue("IdPortalVersion");
			$frame["PubTime"] = ($dbObj->GetValue("Progress") != '100') ? time() - $dbObj->GetValue("PubTime"): $dbObj->GetValue("PubTime");
			$frame["State"] = $dbObj->GetValue("State");
			$frame["Progress"] = $dbObj->GetValue("Progress");
			$frame["FileName"] = $dbObj->GetValue("FileName");
			$frame["FilePath"] = $dbObj->GetValue("FilePath");
			$frame["IdBatch"] = $dbObj->GetValue("IdBatch");
			$frame["IdSync"] = $dbObj->GetValue("IdSync");
			$frame["IdParentServer"] = $dbObj->GetValue("IdParentServer");
			$frame["Error"] = ($dbObj->GetValue("Progress") != '-1') ? 0 : 1;
			$frame["BatchState"] = $batchStates[$dbObj->GetValue("IdBatch")];

			$frames[$frame["IdPortalVersion"]][] = $frame;
			$dbObj->Next();
		}

		return $frames;
    }

}
?>