<?php
// use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity
 * @Table(name="test")
 */
class UserBean {
    /** 
     * @Id @Column(type="integer") 
     * @GeneratedValue
     */
    private $id;
    
    /** @Column(length=30) */
    private $email;

    /**
     * @return the $email
     */
    public function getEmail() {
        return $this->email;
    }

	/**
     * @param field_type $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }
	/**
     * @return the $id
     */
    public function getId() {
        return $this->id;
    }

	/**
     * @param field_type $id
     */
    public function setId($id) {
        $this->id = $id;
    }



}
