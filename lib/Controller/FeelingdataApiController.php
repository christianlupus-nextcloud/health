<?php
declare(strict_types=1);
/**
 * @copyright Copyright (c) 2020 Florian Steffens <flost-dev@mailbox.org>
 *
 * @author Florian Steffens <flost-dev@mailbox.org>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\Health\Controller;

use OCA\Health\Services\FeelingdataService;
use OCP\IRequest;
use OCP\AppFramework\ApiController;
use OCP\AppFramework\Http\DataResponse;

class FeelingdataApiController extends ApiController {

	protected $userId;
	protected $feelingdataService;

	public function __construct($appName, IRequest $request, FeelingdataService $mS, $userId) {
		parent::__construct($appName, $request);
		$this->feelingdataService = $mS;
		$this->userId = $userId;
	}

	/**
	 * @NoAdminRequired
	 * @CORS
	 * @NoCSRFRequired
	 *
	 * @param int $personId
	 * @return DataResponse
	 */
	public function findByPerson(int $personId): DataResponse
	{
        return new DataResponse($this->feelingdataService->getAllByPersonId($personId));
	}

	/**
	 * @NoAdminRequired
	 * @CORS
	 * @NoCSRFRequired
	 *
	 * @param int $personId
	 * @param string $datetime
	 * @param int|null $mood
	 * @param int|null $sadnessLevel
	 * @param string|null $symptoms
	 * @param string|null $attacks
	 * @param string|null $medication
	 * @param int|null $pain
	 * @param int|null $energy
	 * @param string $comment
	 * @return DataResponse
	 */
	public function create(int $personId, string $datetime, int $mood = null, int $sadnessLevel = null, string $symptoms = null, string $attacks = null, string $medication = null, int $pain = null, int $energy = null,  string $comment = ''): DataResponse
	{
		return new DataResponse($this->feelingdataService->create($personId, $datetime, $mood, $sadnessLevel, $symptoms, $attacks, $medication, $pain, $energy, $comment));
	}

	/**
	 * @NoAdminRequired
	 * @CORS
	 * @NoCSRFRequired
	 *
	 * @param int $id
	 * @return DataResponse
	 */
	public function delete(int $id): DataResponse
	{
		return new DataResponse($this->feelingdataService->delete($id));
	}

	/**
	 * @NoAdminRequired
	 * @CORS
	 * @NoCSRFRequired
	 *
	 * @param int $id
	 * @param string $datetime
	 * @param int|null $mood
	 * @param int|null $sadnessLevel
	 * @param string|null $symptoms
	 * @param string|null $attacks
	 * @param string|null $medication
	 * @param int|null $pain
	 * @param int|null $energy
	 * @param string $comment
	 * @return DataResponse
	 */
	public function update(int $id, string $datetime, int $mood = null, int $sadnessLevel = null, string $symptoms = null, string $attacks = null, string $medication = null, int $pain = null, int $energy = null,  string $comment = ''): DataResponse
	{
		return new DataResponse($this->feelingdataService->update($id, $datetime, $mood, $sadnessLevel, $symptoms, $attacks, $medication, $pain, $energy, $comment));
	}
}
