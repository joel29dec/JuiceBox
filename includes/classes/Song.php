<?php
    class Song{
        private $con;
        private $id;
        private $mysqlData;
        private $title;
        private $artistId;
        private $albumId;
        private $genre;
        private $duration;
        private $path;

        public function __construct($con, $id){
            $this->con = $con;
            $this->id = $id;
            $query = mysqli_query($this->con, "SELECT * FROM songs WHERE id='$this->id'");
            $this->mysqlData = mysqli_fetch_array($query);
            $this->title = $this->mysqlData['title'];
            $this->artistId =  $this->mysqlData['artist'];
            $this->albumId = $this->mysqlData['album'];
            $this->genre = $this->mysqlData['genre'];
            $this->duration = $this->mysqlData['duration'];
            $this->path = $this->mysqlData['path'];
        }
        
        public function getTitle(){
            return $this->title;
        }
        public function getArtist(){
            return new Artist($this->con, $this->artistId);
        }
        public function getAlbum(){
            return new Album($this->con, $this->albumId);
        }
        public function getGenre(){
            return $this->genre;
        }
        public function getDuration(){
            return $this->duration;
        }
        public function getPath(){
            return $this->path;
        }
        public function getMysqlData(){
            return $this->mysqlData;
        }
    }
?>