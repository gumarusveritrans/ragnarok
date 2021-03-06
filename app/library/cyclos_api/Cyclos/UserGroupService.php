<?php namespace Cyclos;

/**
 * Service interface for actions related to both groups and users.
 * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/users/UserGroupService.html 
 * WARNING: The API is still experimental, and is subject to change.
 */
class UserGroupService extends Service {

    function __construct() {
        parent::__construct('userGroupService');
    }
    
    /**
     * Changes the group of a user, returning the identifier of the group
     * change log
     * @param dto Java type: org.cyclos.model.users.groups.ChangeGroupDTO
     * @return Java type: java.lang.Long
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/users/UserGroupService.html#changeGroup(org.cyclos.model.users.groups.ChangeGroupDTO)
     */
    public function changeGroup($dto) {
        return $this->run('changeGroup', array($dto));
    }
    
    /**
     * Gets the data needed to change the group of an user.
     * @param locator Java type: org.cyclos.model.users.users.UserLocatorVO
     * @return Java type: org.cyclos.model.users.groups.ChangeGroupData
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/users/UserGroupService.html#getChangeGroupData(org.cyclos.model.users.users.UserLocatorVO)
     */
    public function getChangeGroupData($locator) {
        return $this->run('getChangeGroupData', array($locator));
    }
    
}