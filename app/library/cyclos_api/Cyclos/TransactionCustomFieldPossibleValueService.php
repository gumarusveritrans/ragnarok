<?php namespace Cyclos;

/**
 * Service used for managing possible values of transaction custom fields
 * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransactionCustomFieldPossibleValueService.html 
 * WARNING: The API is still experimental, and is subject to change.
 */
class TransactionCustomFieldPossibleValueService extends Service {

    function __construct() {
        parent::__construct('transactionCustomFieldPossibleValueService');
    }
    
    /**
     * Returns data for details of the given entity
     * @param id Java type: java.lang.Long
     * @return Java type: D
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransactionCustomFieldPossibleValueService.html#getData(java.lang.Long)
     */
    public function getData($id) {
        return $this->run('getData', array($id));
    }
    
    /**
     * Returns data for a new entity with the given context parameters
     * @param params Java type: DP
     * @return Java type: D
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransactionCustomFieldPossibleValueService.html#getDataForNew(DP)
     */
    public function getDataForNew($params) {
        return $this->run('getDataForNew', array($params));
    }
    
    /**
     * Inserts a list of custom field possible values, optionally in a
     * category
     * @param customFieldId Java type: java.lang.Long     * @param categoryId Java type: java.lang.Long     * @param possibleValues Java type: java.util.List
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransactionCustomFieldPossibleValueService.html#insert(java.lang.Long,%20java.lang.Long,%20java.util.List)
     */
    public function insert($customFieldId, $categoryId, $possibleValues) {
        $this->run('insert', array($customFieldId, $categoryId, $possibleValues));
    }
    
    /**
     * Loads a DTO for the entity with the given id, ensuring that the logged
     * user can see the record
     * @param id Java type: java.lang.Long
     * @return Java type: DTO
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransactionCustomFieldPossibleValueService.html#load(java.lang.Long)
     */
    public function load($id) {
        return $this->run('load', array($id));
    }
    
    /**
     * Removes the entity associated with the given identifier
     * @param id Java type: java.lang.Long
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransactionCustomFieldPossibleValueService.html#remove(java.lang.Long)
     */
    public function remove($id) {
        $this->run('remove', array($id));
    }
    
    /**
     * Removes the entities associated with the given identifiers
     * @param ids Java type: java.util.Collection
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransactionCustomFieldPossibleValueService.html#removeAll(java.util.Collection)
     */
    public function removeAll($ids) {
        $this->run('removeAll', array($ids));
    }
    
    /**
     * Saves the given object, returning the generated identifier
     * @param object Java type: DTO
     * @return Java type: java.lang.Long
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransactionCustomFieldPossibleValueService.html#save(DTO)
     */
    public function save($object) {
        return $this->run('save', array($object));
    }
    
    /**
     * Searches for possible values
     * @param query Java type: org.cyclos.model.system.fields.CustomFieldPossibleValueQuery
     * @return Java type: org.cyclos.utils.Page
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/banking/TransactionCustomFieldPossibleValueService.html#search(org.cyclos.model.system.fields.CustomFieldPossibleValueQuery)
     */
    public function search($query) {
        return $this->run('search', array($query));
    }
    
}