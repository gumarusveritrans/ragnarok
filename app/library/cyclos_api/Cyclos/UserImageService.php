<?php namespace Cyclos;

/**
 * Service interface for user images. The parameter for saving images is
 * the user identifier.
 * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/users/UserImageService.html 
 * WARNING: The API is still experimental, and is subject to change.
 */
class UserImageService extends Service {

    function __construct() {
        parent::__construct('userImageService');
    }
    
    /**
     * Returns a list of images for the given owner id
     * @param ownerId Java type: java.lang.Long
     * @return Java type: java.util.List
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/users/UserImageService.html#list(java.lang.Long)
     */
    public function _list($ownerId) {
        return $this->run('list', array($ownerId));
    }
    
    /**
     * Loads a VO by id
     * @param id Java type: java.lang.Long
     * @return Java type: VO
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/users/UserImageService.html#load(java.lang.Long)
     */
    public function load($id) {
        return $this->run('load', array($id));
    }
    
    /**
     * Loads a VO by url id
     * @param key Java type: java.lang.String
     * @return Java type: VO
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/users/UserImageService.html#loadByKey(java.lang.String)
     */
    public function loadByKey($key) {
        return $this->run('loadByKey', array($key));
    }
    
    /**
     * Reads the contents for the image with the given id, with the specified
     * size
     * @param id Java type: java.lang.Long
     * @return Java type: org.cyclos.server.utils.SerializableInputStream
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/users/UserImageService.html#readContent(java.lang.Long)
     */
    public function readContent($id) {
        return $this->run('readContent', array($id));
    }
    
    /**
     * Reads the contents for the image with the given key, with the
     * specified size
     * @param key Java type: java.lang.String
     * @return Java type: org.cyclos.server.utils.SerializableInputStream
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/users/UserImageService.html#readContentByKey(java.lang.String)
     */
    public function readContentByKey($key) {
        return $this->run('readContentByKey', array($key));
    }
    
    /**
     * Removes the given image
     * @param id Java type: java.lang.Long
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/users/UserImageService.html#remove(java.lang.Long)
     */
    public function remove($id) {
        $this->run('remove', array($id));
    }
    
    /**
     * Saves the given image for the given parameter (which depends on each
     * image type), returning the descriptor
     * @param param Java type: NP     * @param name Java type: java.lang.String     * @param contents Java type: org.cyclos.server.utils.SerializableInputStream     * @param contentType Java type: java.lang.String
     * @return Java type: VO
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/users/UserImageService.html#save(NP,%20java.lang.String,%20org.cyclos.server.utils.SerializableInputStream,%20java.lang.String)
     */
    public function save($param, $name, $contents, $contentType) {
        return $this->run('save', array($param, $name, $contents, $contentType));
    }
    
    /**
     * Saves the name of the given image
     * @param id Java type: java.lang.Long     * @param name Java type: java.lang.String
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/users/UserImageService.html#saveName(java.lang.Long,%20java.lang.String)
     */
    public function saveName($id, $name) {
        $this->run('saveName', array($id, $name));
    }
    
    /**
     * Saves the images order
     * @param ownerId Java type: java.lang.Long     * @param imageIds Java type: java.util.List
     * @see http://www.cyclos.org/cyclos4documentation/api-javadoc/org/cyclos/services/users/UserImageService.html#saveOrder(java.lang.Long,%20java.util.List)
     */
    public function saveOrder($ownerId, $imageIds) {
        $this->run('saveOrder', array($ownerId, $imageIds));
    }
    
}