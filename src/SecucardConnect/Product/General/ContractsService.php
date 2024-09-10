<?php

namespace SecucardConnect\Product\General;

use GuzzleHttp\Exception\GuzzleException;
use SecucardConnect\Client\ApiError;
use SecucardConnect\Client\AuthError;
use SecucardConnect\Client\ClientError;
use SecucardConnect\Client\MissingParamsError;
use SecucardConnect\Client\ProductService;
use SecucardConnect\Product\General\Model\BankAccount;
use SecucardConnect\Product\General\Model\PaymentMethodsRequestParams;
use SecucardConnect\Product\Smart\Model\PaymentWizardContractOptions;

/**
 * Provides operations for General/Contracts product.
 * @package SecucardConnect\Product\General
 */
class ContractsService extends ProductService
{
    /**
     * Retrieves available payment methods for given contract
     *
     * @param PaymentMethodsRequestParams $param
     * @param string $contract_id
     * @return string[]
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     */
    public function getAvailablePaymentMethods(PaymentMethodsRequestParams $param, $contract_id)
    {
        return $this->execute($contract_id, 'getAvailablePaymentMethods', null, $param);
    }

    /**
     * Retrieves Payment Wizard options assigned to this contract
     *
     * @param string $contract_id
     * @return bool|mixed|null|string
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws GuzzleException
     */
    public function getPaymentWizardOptions($contract_id)
    {
        return $this->getWithAction($contract_id, 'iframeOptions', null, null, PaymentWizardContractOptions::class);
    }

    /**
     * Remove the accrual flag from all payment transactions of the given contract
     * (this will be done in the background,
     *  so the response TRUE will only indicate the the API has accepted this request)
     *
     * @param string $contractId The general contract id
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

    /**
     * Initiate the update of bank account for the given contract
     *
     * @param string $contractId General-Contract-ID, mandatory, f.e. "GCR_..."
     * @param string $owner bank account owner, mandatory, f.e. "Max Muster"
     * @param string $iban IBAN, mandatory, f.e. "DE12..."
     * @param string|null $bic BIC, recommended, depending on the contract settings this param is mandatory or optional
     * @param string|null $bankname optional
     * @return bool TRUE if successful, throws ApiError otherwise.
     * @throws GuzzleException
     * @throws ApiError
     * @throws AuthError
     * @throws ClientError
     * @throws MissingParamsError
     */
    public function updateBankAccount(string $contractId, string $owner, string $iban, ?string $bic = null, ?string $bankname = null)
    {
        if (empty($contractId)) {
            throw new MissingParamsError('contractId', __METHOD__);
        }

        if (empty($owner)) {
            throw new MissingParamsError('owner', __METHOD__);
        }

        if (empty($iban)) {
            throw new MissingParamsError('iban', __METHOD__);
        }

        $class = $this->resourceMetadata->resourceClass;
        $object = new BankAccount(
            $owner,
            $iban,
            $bic,
            $bankname
        );

        return (bool)$this->execute($contractId, 'updateBankAccount', null, $object, $class);
    }
}
