<?php

/**
 * @license MIT
 */

namespace NerdLab\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Description of ImagesFiles
 *
 * @author Paweł Winiecki
 */
class ImageFile {

    /**
     * @var integer | id of database entry.
     */
    private $id;

    /**
     * @var string | image's name. Using for alt atribute. Persist in DB.
     */
    private $name;

    /**
     * @var string | image's path (name + extension). Using for generate full and web path. Persist in DB.
     */
    private $path;

    /**
     * @var \DateTime | Time of file upload. Persist in DB.
     */
    private $createdOn;

    /**
     * @var \DateTime | Time of file or db entry update. Persist in DB.
     */
    private $updatedOn;

    /**
     * @var Symfony\Component\HttpFoundation\File\UploadedFile | Using during upload and save process. Not persist in DB.
     */
    private $file;
    private $temp;

    /**
     * Set name
     *
     * @param string $name
     * @return ImageFile
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return ImageFile
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return ImageFile
     */
    public function setCreatedOn($createdOn) {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime 
     */
    public function getCreatedOn() {
        return $this->createdOn;
    }

    /**
     * Set updatedOn
     *
     * @param \DateTime $updatedOn
     * @return ImageFile
     */
    public function setUpdatedOn($updatedOn) {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    /**
     * Get updatedOn
     *
     * @return \DateTime 
     */
    public function getUpdatedOn() {
        return $this->updatedOn;
    }

    /**
     * Get absloute path to image.
     *
     * @return string 
     */
    public function getAbsolutePath() {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    /**
     * Get web path to image.
     *
     * @return string 
     */
    public function getWebPath() {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    /**
     * Get upload root directory
     *
     * @return string 
     */
    protected function getUploadRootDir() {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    /**
     * Get upload directory
     *
     * @return string 
     */
    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/images' . $this->createdOn->format('/Y/m');
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null) {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * Staff doing before file upload.
     */
    public function preUpload() {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            //remowe whitspace atd begin and end of string
            $path = trim($this->getFile()->getClientOriginalName());

            //change big letters to small
            $path = strtolower($path);

            //replace spaces with ndash
            $path = str_replace(' ', '-', $path);

            //remove more than one ndash in line
            $path = preg_replace('/[\-]+/', '-', $path);

            //convert diactric letters to ASCII letters
            $path = iconv("utf-8", "ascii//TRANSLIT", $path);

            //remove special characters
            $path = preg_replace('/[^a-z0-9\-\.0]/', '', $path);

            $this->path = $path;
        }
    }

    /**
     * Staff doing during file upload.
     */
    public function upload() {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir() . '/' . $this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * Staff when entry are removing from DB
     */
    public function removeUpload() {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    /**
     * Required by form builder.
     * 
     * @return string
     */
    public function __toString() {
        return $this->name;
    }

}
