<?php

namespace SecucardConnect\Product\Payment;

use GuzzleHttp\Exception\GuzzleException;
use SecucardConnect\Client\ApiError;
use SecucardConnect\Client\AuthError;
use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\MissingParamsError;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Product\Payment\Model\CloneParams;
use SecucardConnect\Product\Payment\Model\CreateSubContractRequest;
use SecucardConnect\Product\Payment\Model\CreateSubContractResponse;
use SecucardConnect\Product\Payment\Model\Transaction;
use SecucardConnect\Product\Services\Model\Contract;


/**
 * Operations for the payment/contracts resource.
 * @package SecucardConnect\Product\Payment
 */
class ContractsService extends ProductService
{
    /**
     * Clones a contract with a given id according to the given parameters and returns the contract.
     *
     * @param string $contractId The id of the parent contract.
     * @param CloneParams $param The parameters for cloning.
     * @return Contract
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function cloneContract($contractId, $param)
    {
        return $this->execute($contractId, 'clone', null, $param, Contract::class);
    }

    /**
     * Get a list of activated payment methods
     *
     * @param string $contractId
     * @return array
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function getPaymentMethods($contractId = 'me')
    {
        return $this->getWithAction($contractId, 'paymentMethods');
    }

    /**
     * Clones the contract of the current user according to the given parameters and returns the contract.
     *
     * @param CloneParams $param The parameters for cloning.
     * @return Contract
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function cloneMyContract($param)
    {
        return $this->cloneContract('me', $param);
    }

    /**
     * Clones the contract of the current user according to the given parameters and returns the contract.
     *
     * @param CreateSubContractRequest $param
     * @param string $contract_id
     * @return CreateSubContractResponse
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     */
    public function createSubContract(CreateSubContractRequest $param, $contract_id = null)
    {
        if (empty($contract_id)) {
            $contract_id = 'me';
        }

        return $this->execute($contract_id, 'requestId', null, $param, CreateSubContractResponse::class);
    }

    /**
     * Remove the accrual flag from all payment transactions of the given contract
     * (this will be done in the background,
     *  so the response TRUE will only indicate the the API has accepted this request)
     *
     * @param string $contractId The payment contract id
     * @return bool
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     * @throws MissingParamsError
     */
    public function revokeAccrual($contractId)
    {
        if (empty($contractId)) {
            throw new MissingParamsError('contractId', __METHOD__);
        }

        return (bool)$this->execute($contractId, 'revokeAccrual');
    }
}
