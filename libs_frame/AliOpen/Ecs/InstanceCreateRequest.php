<?php

namespace AliOpen\Ecs;

use AliOpen\Core\RpcAcsRequest;

/**
 * Request of CreateInstance
 *
 * @method string getResourceOwnerId()
 * @method string getHpcClusterId()
 * @method string getHttpPutResponseHopLimit()
 * @method string getSecurityEnhancementStrategy()
 * @method string getKeyPairName()
 * @method string getSpotPriceLimit()
 * @method string getDeletionProtection()
 * @method string getResourceGroupId()
 * @method string getHostName()
 * @method string getPassword()
 * @method string getStorageSetPartitionNumber()
 * @method array getTags()
 * @method string getAutoRenewPeriod()
 * @method string getNodeControllerId()
 * @method string getPeriod()
 * @method string getDryRun()
 * @method string getOwnerId()
 * @method string getCapacityReservationPreference()
 * @method string getVSwitchId()
 * @method string getPrivateIpAddress()
 * @method string getSpotStrategy()
 * @method string getPeriodUnit()
 * @method string getInstanceName()
 * @method string getAutoRenew()
 * @method string getInternetChargeType()
 * @method string getZoneId()
 * @method string getInternetMaxBandwidthIn()
 * @method string getUseAdditionalService()
 * @method string getAffinity()
 * @method string getImageId()
 * @method string getClientToken()
 * @method string getVlanId()
 * @method string getSpotInterruptionBehavior()
 * @method string getIoOptimized()
 * @method string getSecurityGroupId()
 * @method string getInternetMaxBandwidthOut()
 * @method string getDescription()
 * @method string getSystemDiskCategory()
 * @method string getCapacityReservationId()
 * @method string getSystemDiskPerformanceLevel()
 * @method string getUserData()
 * @method string getPasswordInherit()
 * @method string getHttpEndpoint()
 * @method string getInstanceType()
 * @method array getArns()
 * @method string getInstanceChargeType()
 * @method string getDeploymentSetId()
 * @method string getInnerIpAddress()
 * @method string getResourceOwnerAccount()
 * @method string getOwnerAccount()
 * @method string getTenancy()
 * @method string getSystemDiskDiskName()
 * @method string getRamRoleName()
 * @method string getDedicatedHostId()
 * @method string getClusterId()
 * @method string getCreditSpecification()
 * @method string getSpotDuration()
 * @method array getDataDisks()
 * @method string getStorageSetId()
 * @method string getSystemDiskSize()
 * @method string getImageFamily()
 * @method string getHttpTokens()
 * @method string getSystemDiskDescription()
 */
class InstanceCreateRequest extends RpcAcsRequest
{
    /**
     * @var string
     */
    protected $method = 'POST';

    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('Ecs', '2014-05-26', 'CreateInstance', 'ecs');
    }

    /**
     * @param string $resourceOwnerId
     *
     * @return $this
     */
    public function setResourceOwnerId($resourceOwnerId)
    {
        $this->requestParameters['ResourceOwnerId'] = $resourceOwnerId;
        $this->queryParameters['ResourceOwnerId'] = $resourceOwnerId;

        return $this;
    }

    /**
     * @param string $hpcClusterId
     *
     * @return $this
     */
    public function setHpcClusterId($hpcClusterId)
    {
        $this->requestParameters['HpcClusterId'] = $hpcClusterId;
        $this->queryParameters['HpcClusterId'] = $hpcClusterId;

        return $this;
    }

    /**
     * @param string $httpPutResponseHopLimit
     *
     * @return $this
     */
    public function setHttpPutResponseHopLimit($httpPutResponseHopLimit)
    {
        $this->requestParameters['HttpPutResponseHopLimit'] = $httpPutResponseHopLimit;
        $this->queryParameters['HttpPutResponseHopLimit'] = $httpPutResponseHopLimit;

        return $this;
    }

    /**
     * @param string $securityEnhancementStrategy
     *
     * @return $this
     */
    public function setSecurityEnhancementStrategy($securityEnhancementStrategy)
    {
        $this->requestParameters['SecurityEnhancementStrategy'] = $securityEnhancementStrategy;
        $this->queryParameters['SecurityEnhancementStrategy'] = $securityEnhancementStrategy;

        return $this;
    }

    /**
     * @param string $keyPairName
     *
     * @return $this
     */
    public function setKeyPairName($keyPairName)
    {
        $this->requestParameters['KeyPairName'] = $keyPairName;
        $this->queryParameters['KeyPairName'] = $keyPairName;

        return $this;
    }

    /**
     * @param string $spotPriceLimit
     *
     * @return $this
     */
    public function setSpotPriceLimit($spotPriceLimit)
    {
        $this->requestParameters['SpotPriceLimit'] = $spotPriceLimit;
        $this->queryParameters['SpotPriceLimit'] = $spotPriceLimit;

        return $this;
    }

    /**
     * @param string $deletionProtection
     *
     * @return $this
     */
    public function setDeletionProtection($deletionProtection)
    {
        $this->requestParameters['DeletionProtection'] = $deletionProtection;
        $this->queryParameters['DeletionProtection'] = $deletionProtection;

        return $this;
    }

    /**
     * @param string $resourceGroupId
     *
     * @return $this
     */
    public function setResourceGroupId($resourceGroupId)
    {
        $this->requestParameters['ResourceGroupId'] = $resourceGroupId;
        $this->queryParameters['ResourceGroupId'] = $resourceGroupId;

        return $this;
    }

    /**
     * @param string $hostName
     *
     * @return $this
     */
    public function setHostName($hostName)
    {
        $this->requestParameters['HostName'] = $hostName;
        $this->queryParameters['HostName'] = $hostName;

        return $this;
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->requestParameters['Password'] = $password;
        $this->queryParameters['Password'] = $password;

        return $this;
    }

    /**
     * @param string $storageSetPartitionNumber
     *
     * @return $this
     */
    public function setStorageSetPartitionNumber($storageSetPartitionNumber)
    {
        $this->requestParameters['StorageSetPartitionNumber'] = $storageSetPartitionNumber;
        $this->queryParameters['StorageSetPartitionNumber'] = $storageSetPartitionNumber;

        return $this;
    }

    /**
     * @return $this
     */
    public function setTags(array $tag)
    {
        $this->requestParameters['Tags'] = $tag;
        foreach ($tag as $depth1 => $depth1Value) {
            $this->queryParameters['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
            $this->queryParameters['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
        }

        return $this;
    }

    /**
     * @param string $autoRenewPeriod
     *
     * @return $this
     */
    public function setAutoRenewPeriod($autoRenewPeriod)
    {
        $this->requestParameters['AutoRenewPeriod'] = $autoRenewPeriod;
        $this->queryParameters['AutoRenewPeriod'] = $autoRenewPeriod;

        return $this;
    }

    /**
     * @param string $nodeControllerId
     *
     * @return $this
     */
    public function setNodeControllerId($nodeControllerId)
    {
        $this->requestParameters['NodeControllerId'] = $nodeControllerId;
        $this->queryParameters['NodeControllerId'] = $nodeControllerId;

        return $this;
    }

    /**
     * @param string $period
     *
     * @return $this
     */
    public function setPeriod($period)
    {
        $this->requestParameters['Period'] = $period;
        $this->queryParameters['Period'] = $period;

        return $this;
    }

    /**
     * @param string $dryRun
     *
     * @return $this
     */
    public function setDryRun($dryRun)
    {
        $this->requestParameters['DryRun'] = $dryRun;
        $this->queryParameters['DryRun'] = $dryRun;

        return $this;
    }

    /**
     * @param string $ownerId
     *
     * @return $this
     */
    public function setOwnerId($ownerId)
    {
        $this->requestParameters['OwnerId'] = $ownerId;
        $this->queryParameters['OwnerId'] = $ownerId;

        return $this;
    }

    /**
     * @param string $capacityReservationPreference
     *
     * @return $this
     */
    public function setCapacityReservationPreference($capacityReservationPreference)
    {
        $this->requestParameters['CapacityReservationPreference'] = $capacityReservationPreference;
        $this->queryParameters['CapacityReservationPreference'] = $capacityReservationPreference;

        return $this;
    }

    /**
     * @param string $vSwitchId
     *
     * @return $this
     */
    public function setVSwitchId($vSwitchId)
    {
        $this->requestParameters['VSwitchId'] = $vSwitchId;
        $this->queryParameters['VSwitchId'] = $vSwitchId;

        return $this;
    }

    /**
     * @param string $privateIpAddress
     *
     * @return $this
     */
    public function setPrivateIpAddress($privateIpAddress)
    {
        $this->requestParameters['PrivateIpAddress'] = $privateIpAddress;
        $this->queryParameters['PrivateIpAddress'] = $privateIpAddress;

        return $this;
    }

    /**
     * @param string $spotStrategy
     *
     * @return $this
     */
    public function setSpotStrategy($spotStrategy)
    {
        $this->requestParameters['SpotStrategy'] = $spotStrategy;
        $this->queryParameters['SpotStrategy'] = $spotStrategy;

        return $this;
    }

    /**
     * @param string $periodUnit
     *
     * @return $this
     */
    public function setPeriodUnit($periodUnit)
    {
        $this->requestParameters['PeriodUnit'] = $periodUnit;
        $this->queryParameters['PeriodUnit'] = $periodUnit;

        return $this;
    }

    /**
     * @param string $instanceName
     *
     * @return $this
     */
    public function setInstanceName($instanceName)
    {
        $this->requestParameters['InstanceName'] = $instanceName;
        $this->queryParameters['InstanceName'] = $instanceName;

        return $this;
    }

    /**
     * @param string $autoRenew
     *
     * @return $this
     */
    public function setAutoRenew($autoRenew)
    {
        $this->requestParameters['AutoRenew'] = $autoRenew;
        $this->queryParameters['AutoRenew'] = $autoRenew;

        return $this;
    }

    /**
     * @param string $internetChargeType
     *
     * @return $this
     */
    public function setInternetChargeType($internetChargeType)
    {
        $this->requestParameters['InternetChargeType'] = $internetChargeType;
        $this->queryParameters['InternetChargeType'] = $internetChargeType;

        return $this;
    }

    /**
     * @param string $zoneId
     *
     * @return $this
     */
    public function setZoneId($zoneId)
    {
        $this->requestParameters['ZoneId'] = $zoneId;
        $this->queryParameters['ZoneId'] = $zoneId;

        return $this;
    }

    /**
     * @param string $internetMaxBandwidthIn
     *
     * @return $this
     */
    public function setInternetMaxBandwidthIn($internetMaxBandwidthIn)
    {
        $this->requestParameters['InternetMaxBandwidthIn'] = $internetMaxBandwidthIn;
        $this->queryParameters['InternetMaxBandwidthIn'] = $internetMaxBandwidthIn;

        return $this;
    }

    /**
     * @param string $useAdditionalService
     *
     * @return $this
     */
    public function setUseAdditionalService($useAdditionalService)
    {
        $this->requestParameters['UseAdditionalService'] = $useAdditionalService;
        $this->queryParameters['UseAdditionalService'] = $useAdditionalService;

        return $this;
    }

    /**
     * @param string $affinity
     *
     * @return $this
     */
    public function setAffinity($affinity)
    {
        $this->requestParameters['Affinity'] = $affinity;
        $this->queryParameters['Affinity'] = $affinity;

        return $this;
    }

    /**
     * @param string $imageId
     *
     * @return $this
     */
    public function setImageId($imageId)
    {
        $this->requestParameters['ImageId'] = $imageId;
        $this->queryParameters['ImageId'] = $imageId;

        return $this;
    }

    /**
     * @param string $clientToken
     *
     * @return $this
     */
    public function setClientToken($clientToken)
    {
        $this->requestParameters['ClientToken'] = $clientToken;
        $this->queryParameters['ClientToken'] = $clientToken;

        return $this;
    }

    /**
     * @param string $vlanId
     *
     * @return $this
     */
    public function setVlanId($vlanId)
    {
        $this->requestParameters['VlanId'] = $vlanId;
        $this->queryParameters['VlanId'] = $vlanId;

        return $this;
    }

    /**
     * @param string $spotInterruptionBehavior
     *
     * @return $this
     */
    public function setSpotInterruptionBehavior($spotInterruptionBehavior)
    {
        $this->requestParameters['SpotInterruptionBehavior'] = $spotInterruptionBehavior;
        $this->queryParameters['SpotInterruptionBehavior'] = $spotInterruptionBehavior;

        return $this;
    }

    /**
     * @param string $ioOptimized
     *
     * @return $this
     */
    public function setIoOptimized($ioOptimized)
    {
        $this->requestParameters['IoOptimized'] = $ioOptimized;
        $this->queryParameters['IoOptimized'] = $ioOptimized;

        return $this;
    }

    /**
     * @param string $securityGroupId
     *
     * @return $this
     */
    public function setSecurityGroupId($securityGroupId)
    {
        $this->requestParameters['SecurityGroupId'] = $securityGroupId;
        $this->queryParameters['SecurityGroupId'] = $securityGroupId;

        return $this;
    }

    /**
     * @param string $internetMaxBandwidthOut
     *
     * @return $this
     */
    public function setInternetMaxBandwidthOut($internetMaxBandwidthOut)
    {
        $this->requestParameters['InternetMaxBandwidthOut'] = $internetMaxBandwidthOut;
        $this->queryParameters['InternetMaxBandwidthOut'] = $internetMaxBandwidthOut;

        return $this;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->requestParameters['Description'] = $description;
        $this->queryParameters['Description'] = $description;

        return $this;
    }

    /**
     * @param string $systemDiskCategory
     *
     * @return $this
     */
    public function setSystemDiskCategory($systemDiskCategory)
    {
        $this->requestParameters['SystemDiskCategory'] = $systemDiskCategory;
        $this->queryParameters['SystemDisk.Category'] = $systemDiskCategory;

        return $this;
    }

    /**
     * @param string $capacityReservationId
     *
     * @return $this
     */
    public function setCapacityReservationId($capacityReservationId)
    {
        $this->requestParameters['CapacityReservationId'] = $capacityReservationId;
        $this->queryParameters['CapacityReservationId'] = $capacityReservationId;

        return $this;
    }

    /**
     * @param string $systemDiskPerformanceLevel
     *
     * @return $this
     */
    public function setSystemDiskPerformanceLevel($systemDiskPerformanceLevel)
    {
        $this->requestParameters['SystemDiskPerformanceLevel'] = $systemDiskPerformanceLevel;
        $this->queryParameters['SystemDisk.PerformanceLevel'] = $systemDiskPerformanceLevel;

        return $this;
    }

    /**
     * @param string $userData
     *
     * @return $this
     */
    public function setUserData($userData)
    {
        $this->requestParameters['UserData'] = $userData;
        $this->queryParameters['UserData'] = $userData;

        return $this;
    }

    /**
     * @param string $passwordInherit
     *
     * @return $this
     */
    public function setPasswordInherit($passwordInherit)
    {
        $this->requestParameters['PasswordInherit'] = $passwordInherit;
        $this->queryParameters['PasswordInherit'] = $passwordInherit;

        return $this;
    }

    /**
     * @param string $httpEndpoint
     *
     * @return $this
     */
    public function setHttpEndpoint($httpEndpoint)
    {
        $this->requestParameters['HttpEndpoint'] = $httpEndpoint;
        $this->queryParameters['HttpEndpoint'] = $httpEndpoint;

        return $this;
    }

    /**
     * @param string $instanceType
     *
     * @return $this
     */
    public function setInstanceType($instanceType)
    {
        $this->requestParameters['InstanceType'] = $instanceType;
        $this->queryParameters['InstanceType'] = $instanceType;

        return $this;
    }

    /**
     * @return $this
     */
    public function setArns(array $arn)
    {
        $this->requestParameters['Arns'] = $arn;
        foreach ($arn as $depth1 => $depth1Value) {
            $this->queryParameters['Arn.' . ($depth1 + 1) . '.Rolearn'] = $depth1Value['Rolearn'];
            $this->queryParameters['Arn.' . ($depth1 + 1) . '.RoleType'] = $depth1Value['RoleType'];
            $this->queryParameters['Arn.' . ($depth1 + 1) . '.AssumeRoleFor'] = $depth1Value['AssumeRoleFor'];
        }

        return $this;
    }

    /**
     * @param string $instanceChargeType
     *
     * @return $this
     */
    public function setInstanceChargeType($instanceChargeType)
    {
        $this->requestParameters['InstanceChargeType'] = $instanceChargeType;
        $this->queryParameters['InstanceChargeType'] = $instanceChargeType;

        return $this;
    }

    /**
     * @param string $deploymentSetId
     *
     * @return $this
     */
    public function setDeploymentSetId($deploymentSetId)
    {
        $this->requestParameters['DeploymentSetId'] = $deploymentSetId;
        $this->queryParameters['DeploymentSetId'] = $deploymentSetId;

        return $this;
    }

    /**
     * @param string $innerIpAddress
     *
     * @return $this
     */
    public function setInnerIpAddress($innerIpAddress)
    {
        $this->requestParameters['InnerIpAddress'] = $innerIpAddress;
        $this->queryParameters['InnerIpAddress'] = $innerIpAddress;

        return $this;
    }

    /**
     * @param string $resourceOwnerAccount
     *
     * @return $this
     */
    public function setResourceOwnerAccount($resourceOwnerAccount)
    {
        $this->requestParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;
        $this->queryParameters['ResourceOwnerAccount'] = $resourceOwnerAccount;

        return $this;
    }

    /**
     * @param string $ownerAccount
     *
     * @return $this
     */
    public function setOwnerAccount($ownerAccount)
    {
        $this->requestParameters['OwnerAccount'] = $ownerAccount;
        $this->queryParameters['OwnerAccount'] = $ownerAccount;

        return $this;
    }

    /**
     * @param string $tenancy
     *
     * @return $this
     */
    public function setTenancy($tenancy)
    {
        $this->requestParameters['Tenancy'] = $tenancy;
        $this->queryParameters['Tenancy'] = $tenancy;

        return $this;
    }

    /**
     * @param string $systemDiskDiskName
     *
     * @return $this
     */
    public function setSystemDiskDiskName($systemDiskDiskName)
    {
        $this->requestParameters['SystemDiskDiskName'] = $systemDiskDiskName;
        $this->queryParameters['SystemDisk.DiskName'] = $systemDiskDiskName;

        return $this;
    }

    /**
     * @param string $ramRoleName
     *
     * @return $this
     */
    public function setRamRoleName($ramRoleName)
    {
        $this->requestParameters['RamRoleName'] = $ramRoleName;
        $this->queryParameters['RamRoleName'] = $ramRoleName;

        return $this;
    }

    /**
     * @param string $dedicatedHostId
     *
     * @return $this
     */
    public function setDedicatedHostId($dedicatedHostId)
    {
        $this->requestParameters['DedicatedHostId'] = $dedicatedHostId;
        $this->queryParameters['DedicatedHostId'] = $dedicatedHostId;

        return $this;
    }

    /**
     * @param string $clusterId
     *
     * @return $this
     */
    public function setClusterId($clusterId)
    {
        $this->requestParameters['ClusterId'] = $clusterId;
        $this->queryParameters['ClusterId'] = $clusterId;

        return $this;
    }

    /**
     * @param string $creditSpecification
     *
     * @return $this
     */
    public function setCreditSpecification($creditSpecification)
    {
        $this->requestParameters['CreditSpecification'] = $creditSpecification;
        $this->queryParameters['CreditSpecification'] = $creditSpecification;

        return $this;
    }

    /**
     * @param string $spotDuration
     *
     * @return $this
     */
    public function setSpotDuration($spotDuration)
    {
        $this->requestParameters['SpotDuration'] = $spotDuration;
        $this->queryParameters['SpotDuration'] = $spotDuration;

        return $this;
    }

    /**
     * @return $this
     */
    public function setDataDisks(array $dataDisk)
    {
        $this->requestParameters['DataDisks'] = $dataDisk;
        foreach ($dataDisk as $depth1 => $depth1Value) {
            $this->queryParameters['DataDisk.' . ($depth1 + 1) . '.DiskName'] = $depth1Value['DiskName'];
            $this->queryParameters['DataDisk.' . ($depth1 + 1) . '.SnapshotId'] = $depth1Value['SnapshotId'];
            $this->queryParameters['DataDisk.' . ($depth1 + 1) . '.Size'] = $depth1Value['Size'];
            $this->queryParameters['DataDisk.' . ($depth1 + 1) . '.Encrypted'] = $depth1Value['Encrypted'];
            $this->queryParameters['DataDisk.' . ($depth1 + 1) . '.PerformanceLevel'] = $depth1Value['PerformanceLevel'];
            $this->queryParameters['DataDisk.' . ($depth1 + 1) . '.EncryptAlgorithm'] = $depth1Value['EncryptAlgorithm'];
            $this->queryParameters['DataDisk.' . ($depth1 + 1) . '.Description'] = $depth1Value['Description'];
            $this->queryParameters['DataDisk.' . ($depth1 + 1) . '.Category'] = $depth1Value['Category'];
            $this->queryParameters['DataDisk.' . ($depth1 + 1) . '.KMSKeyId'] = $depth1Value['KMSKeyId'];
            $this->queryParameters['DataDisk.' . ($depth1 + 1) . '.Device'] = $depth1Value['Device'];
            $this->queryParameters['DataDisk.' . ($depth1 + 1) . '.DeleteWithInstance'] = $depth1Value['DeleteWithInstance'];
        }

        return $this;
    }

    /**
     * @param string $storageSetId
     *
     * @return $this
     */
    public function setStorageSetId($storageSetId)
    {
        $this->requestParameters['StorageSetId'] = $storageSetId;
        $this->queryParameters['StorageSetId'] = $storageSetId;

        return $this;
    }

    /**
     * @param string $systemDiskSize
     *
     * @return $this
     */
    public function setSystemDiskSize($systemDiskSize)
    {
        $this->requestParameters['SystemDiskSize'] = $systemDiskSize;
        $this->queryParameters['SystemDisk.Size'] = $systemDiskSize;

        return $this;
    }

    /**
     * @param string $imageFamily
     *
     * @return $this
     */
    public function setImageFamily($imageFamily)
    {
        $this->requestParameters['ImageFamily'] = $imageFamily;
        $this->queryParameters['ImageFamily'] = $imageFamily;

        return $this;
    }

    /**
     * @param string $httpTokens
     *
     * @return $this
     */
    public function setHttpTokens($httpTokens)
    {
        $this->requestParameters['HttpTokens'] = $httpTokens;
        $this->queryParameters['HttpTokens'] = $httpTokens;

        return $this;
    }

    /**
     * @param string $systemDiskDescription
     *
     * @return $this
     */
    public function setSystemDiskDescription($systemDiskDescription)
    {
        $this->requestParameters['SystemDiskDescription'] = $systemDiskDescription;
        $this->queryParameters['SystemDisk.Description'] = $systemDiskDescription;

        return $this;
    }
}
