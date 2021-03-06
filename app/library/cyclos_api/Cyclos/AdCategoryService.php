<?php namespace Cyclos;

/**
 * Service interface for ad categories
 * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/marketplace/AdCategoryService.html 
 * WARNING: The API is still experimental, and is subject to change.
 */
class AdCategoryService extends Service {

    function __construct() {
        parent::__construct('adCategoryService');
    }
    
    /**
     * Returns data for details of the given entity
     * @param id Java type: java.lang.Long
     * @return Java type: D
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/marketplace/AdCategoryService.html#getData(java.lang.Long)
     */
    public function getData($id) {
        return $this->run('getData', array($id));
    }
    
    /**
     * Returns data for a new entity with the given context parameters
     * @param params Java type: DP
     * @return Java type: D
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/marketplace/AdCategoryService.html#getDataForNew(DP)
     */
    public function getDataForNew($params) {
        return $this->run('getDataForNew', array($params));
    }
    
    /**
     * Loads a DTO for the entity with the given id, ensuring that the logged
     * user can see the record
     * @param id Java type: java.lang.Long
     * @return Java type: DTO
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/marketplace/AdCategoryService.html#load(java.lang.Long)
     */
    public function load($id) {
        return $this->run('load', array($id));
    }
    
    /**
     * Removes the entity associated with the given identifier
     * @param id Java type: java.lang.Long
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/marketplace/AdCategoryService.html#remove(java.lang.Long)
     */
    public function remove($id) {
        $this->run('remove', array($id));
    }
    
    /**
     * Removes the entities associated with the given identifiers
     * @param ids Java type: java.util.Collection
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/marketplace/AdCategoryService.html#removeAll(java.util.Collection)
     */
    public function removeAll($ids) {
        $this->run('removeAll', array($ids));
    }
    
    /**
     * Saves the given object, returning the generated identifier
     * @param object Java type: DTO
     * @return Java type: java.lang.Long
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/marketplace/AdCategoryService.html#save(DTO)
     */
    public function save($object) {
        return $this->run('save', array($object));
    }
    
    /**
     * Saves several categories
     * @param categories Java type: java.util.List
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/marketplace/AdCategoryService.html#saveCategories(java.util.List)
     */
    public function saveCategories($categories) {
        $this->run('saveCategories', array($categories));
    }
    
    /**
     * Updates the order field according to the sequence on AdCategoryVOs set
     * @param categoryIds Java type: java.util.List
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/marketplace/AdCategoryService.html#saveOrder(java.util.List)
     */
    public function saveOrder($categoryIds) {
        $this->run('saveOrder', array($categoryIds));
    }
    
    /**
     * Searches categories according to parameters
     * @param params Java type: org.cyclos.model.marketplace.categories.AdCategoryQuery
     * @return Java type: org.cyclos.utils.Page
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/marketplace/AdCategoryService.html#search(org.cyclos.model.marketplace.categories.AdCategoryQuery)
     */
    public function search($params) {
        return $this->run('search', array($params));
    }
    
    /**
     * Updates the order field of categories child of the category with the
     * given id (or root if id is null) alphabetically (by name)
     * @param parentId Java type: java.lang.Long
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/marketplace/AdCategoryService.html#sortAlphabetically(java.lang.Long)
     */
    public function sortAlphabetically($parentId) {
        $this->run('sortAlphabetically', array($parentId));
    }
    
}