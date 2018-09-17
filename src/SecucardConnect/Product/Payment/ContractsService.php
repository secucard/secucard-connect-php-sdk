<?php

namespace SecucardConnect\Product\Payment;

use SecucardConnect\Client\ProductService;
use SecucardConnect\Product\Payment\Model\CloneParams;
use SecucardConnect\Product\Payment\Model\CreateSubContractRequest;
use SecucardConnect\Product\Payment\Model\CreateSubContractResponse;
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
     * @param $contractId string The id of the parent contract.
     * @param $param CloneParams The parameters for cloning.
     * @return Contract
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
     */
    public function getPaymentMethods($contractId = 'me')
    {
        return $this->execute($contractId, 'GetPaymentMethods');
    }

    /**
     * Clones the contract of the current user according to the given parameters and returns the contract.
     *
     * @param $param CloneParams The parameters for cloning.
     * @return Contract
     */
    public function cloneMyContract($param)
    {
        return $this->cloneContract('me', $param);
    }

    /**
     * Clones the contract of the current user according to the given parameters and returns the contract.
     *
     * @param CreateSubContractRequest $param
     * @return CreateSubContractResponse
     */
    public function createSubContract(CreateSubContractRequest $param)
    {
        return $this->execute('me', 'requestId', null, $param, CreateSubContractResponse::class);
    }
}
