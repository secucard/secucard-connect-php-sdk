<?php
/** @noinspection PhpUnnecessaryFullyQualifiedNameInspection */
/** @noinspection PhpUnused */

namespace SecucardConnect\Product\Services\Model;

use SecucardConnect\Product\Common\Model\BaseModel;

/**
 * Identcase Api Model class
 *
 */
class IdentCase extends BaseModel
{
    const STATUS_CREATED = 'created';
    const STATUS_UPDATED = 'updated';
    const STATUS_OPEN_TASKS = 'open_tasks';
    const STATUS_FINISHED_TASKS = 'finished_tasks';
    const STATUS_FINISHED = 'finished';
    const STATUS_CANCELED = 'canceled';

    const LEGAL_TYPE_INDIVIDUAL = 'individual';
    const LEGAL_TYPE_EK = 'ek';
    const LEGAL_TYPE_GBR = 'gbr';
    const LEGAL_TYPE_GBH = 'gbh';
    const LEGAL_TYPE_AG = 'ag';
    const LEGAL_TYPE_KG = 'kg';
    const LEGAL_TYPE_GMBHCOKG = 'gmbhcokg';
    const LEGAL_TYPE_AGCOKG = 'agcokg';
    const LEGAL_TYPE_OHG = 'ohg';
    const LEGAL_TYPE_EV = 'ev';
    const LEGAL_TYPE_EG = 'eg';

    const TASK_GROUP_TYPE_COMPANY = 'company';
    const TASK_GROUP_TYPE_PERSON = 'person';

    const TASK_STATUS_OPEN = 'open';
    const TASK_STATUS_INVALID = 'invalid';
    const TASK_STATUS_OK = 'ok';

    const TASK_TYPE_UPLOAD_DOCUMENT = 'document_upload';
    const TASK_TYPE_IDENTIFY_PERSON = 'ident_person';

    const ADDITIONAL_TYPE_WB_PERSON = 'wb_person';
    const ADDITIONAL_TYPE_WB_COMPANY = 'wb_company';
    const ADDITIONAL_TYPE_AUTHORIZED_REPRESENTATIVE = 'auth_rep';

    const TASK_TYPE_UPLOAD_DOCUMENT_ID = 'id'; // Personalausweis Vorderseite
    const TASK_TYPE_UPLOAD_DOCUMENT_ID_BACK = 'id_back'; // Personalausweis Ruckseite
    const TASK_TYPE_UPLOAD_DOCUMENT_GA = 'ga'; // Gewerbeanmeldung
    const TASK_TYPE_UPLOAD_DOCUMENT_HR = 'hr'; // Handelsregisterauszug
    const TASK_TYPE_UPLOAD_DOCUMENT_HRK = 'hrk'; // Handelsregisterauszug - Komplementar-Gesellschaft
    const TASK_TYPE_UPLOAD_DOCUMENT_VR = 'vr'; // Vereinsregister
    const TASK_TYPE_UPLOAD_DOCUMENT_GR = 'gr'; // Genossenschaftsregister
    const TASK_TYPE_UPLOAD_DOCUMENT_DOC = 'doc'; // Satzung (Grundungsdokument)
    const TASK_TYPE_UPLOAD_DOCUMENT_DOCGVML = 'docgvml'; // Gesellschaftsvertrag mit Mitgliederliste

    /**
     * @var string
     */
    public $object;

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $status;

    /**
     * @var Company
     */
    public $company;

    /**
     * @var Contact
     */
    public $contact_person;

    /**
     * @var Contact[]
     */
    public $authorised_representative;

    /**
     * @var Contact[]
     */
    public $beneficial_owner;

    /**
     * @var string[]
     */
    public $request_additional;

    /**
     * @var Tasks[]
     */
    public $task;

    /**
     * @var \SecucardConnect\Product\Common\Model\BaseModel
     */
    public $owner;
}

