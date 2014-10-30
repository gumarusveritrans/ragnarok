<?php namespace Cyclos;

/**
 * Service used to retrieve flash notifications
 * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/messaging/FlashNotificationService.html 
 * WARNING: The API is still experimental, and is subject to change.
 */
class FlashNotificationService extends Service {

    function __construct() {
        parent::__construct('flashNotificationService');
    }
    
    /**
     * Creates a new flash notification
     * @param notification Java type: org.cyclos.model.messaging.notifications.FlashNotificationDTO
     * @return Java type: java.lang.Long
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/messaging/FlashNotificationService.html#create(org.cyclos.model.messaging.notifications.FlashNotificationDTO)
     */
    public function create($notification) {
        return $this->run('create', array($notification));
    }
    
    /**
     * Returns the flash notification with the given identifier, removing it
     * if found. If not found, returns null
     * @param id Java type: java.lang.Long
     * @return Java type: org.cyclos.model.messaging.notifications.FlashNotificationDTO
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/messaging/FlashNotificationService.html#get(java.lang.Long)
     */
    public function get($id) {
        return $this->run('get', array($id));
    }
    
}