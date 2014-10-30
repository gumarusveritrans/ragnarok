<?php namespace Cyclos;

/**
 * Service interface for managing transfer statuses (normally related to
 * bookkeeping, but could have a broader meaning)
 * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransferStatusService.html 
 * WARNING: The API is still experimental, and is subject to change.
 */
class TransferStatusService extends Service {

    function __construct() {
        parent::__construct('transferStatusService');
    }
    
    /**
     * Changes the status of the given transfer
     * @param params Java type: org.cyclos.model.banking.transferstatus.ChangeTransferStatusDTO
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransferStatusService.html#changeStatus(org.cyclos.model.banking.transferstatus.ChangeTransferStatusDTO)
     */
    public function changeStatus($params) {
        $this->run('changeStatus', array($params));
    }
    
    /**
     * Returns data for details of the given entity
     * @param id Java type: java.lang.Long
     * @return Java type: D
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransferStatusService.html#getData(java.lang.Long)
     */
    public function getData($id) {
        return $this->run('getData', array($id));
    }
    
    /**
     * Returns data for a new entity with the given context parameters
     * @param params Java type: DP
     * @return Java type: D
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransferStatusService.html#getDataForNew(DP)
     */
    public function getDataForNew($params) {
        return $this->run('getDataForNew', array($params));
    }
    
    /**
     * Returns all transfer statuses in the flow with the given identifier
     * @param flowId Java type: java.lang.Long
     * @return Java type: java.util.List
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransferStatusService.html#list(java.lang.Long)
     */
    public function _list($flowId) {
        return $this->run('list', array($flowId));
    }
    
    /**
     * Loads a DTO for the entity with the given id, ensuring that the logged
     * user can see the record
     * @param id Java type: java.lang.Long
     * @return Java type: DTO
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransferStatusService.html#load(java.lang.Long)
     */
    public function load($id) {
        return $this->run('load', array($id));
    }
    
    /**
     * Removes the entity associated with the given identifier
     * @param id Java type: java.lang.Long
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransferStatusService.html#remove(java.lang.Long)
     */
    public function remove($id) {
        $this->run('remove', array($id));
    }
    
    /**
     * Removes the entities associated with the given identifiers
     * @param ids Java type: java.util.Collection
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransferStatusService.html#removeAll(java.util.Collection)
     */
    public function removeAll($ids) {
        $this->run('removeAll', array($ids));
    }
    
    /**
     * Saves the given object, returning the generated identifier
     * @param object Java type: DTO
     * @return Java type: java.lang.Long
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransferStatusService.html#save(DTO)
     */
    public function save($object) {
        return $this->run('save', array($object));
    }
    
}