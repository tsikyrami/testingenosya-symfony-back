<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $iid;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"User:exo4"})
     */
    private $gender;

    /**
     * @ORM\ManyToOne(targetEntity=Name::class, cascade={"persist", "remove"})
     * @Groups({"User:exo2","User:exo4"})
     * 
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, cascade={"persist", "remove"})
     * @Groups({"User:exo4"})
     */
    private $location;

    /**
     * @ORM\Column(type="string", length=255, nullable="true")
     * @Groups({"User:exo2","User:exo4"})
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Login::class, cascade={"persist", "remove"})
     * @Groups({"User:exo2","User:exo4"})
     */
    private $login;

    /**
     * @ORM\ManyToOne(targetEntity=Dob::class, cascade={"persist", "remove"})
     * @Groups({"User:exo4"})
     */
    private $dob;

    /**
     * @ORM\ManyToOne(targetEntity=Registered::class, cascade={"persist", "remove"})
     * @Groups({"User:exo2","User:exo4"})
     */
    private $registered;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"User:exo4"})
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"User:exo4"})
     */
    private $cell;

    /**
     * @ORM\ManyToOne(targetEntity=Picture::class, cascade={"persist", "remove"})
     * @Groups({"User:exo2","User:exo4"})
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"User:exo4"})
     */
    private $nat;

    /**
     * @ORM\ManyToOne(targetEntity=Id::class, inversedBy="users", cascade={"persist", "remove"})
     */
    private $Id;

    public function getIid(): ?int
    {
        return $this->iid;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getName(): ?Name
    {
        return $this->name;
    }

    public function setName(?Name $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLogin(): ?Login
    {
        return $this->login;
    }

    public function setLogin(?Login $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getDob(): ?Dob
    {
        return $this->dob;
    }

    public function setDob(?Dob $dob): self
    {
        $this->dob = $dob;

        return $this;
    }

    public function getRegistered(): ?Registered
    {
        return $this->registered;
    }

    public function setRegistered(?Registered $registered): self
    {
        $this->registered = $registered;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCell(): ?string
    {
        return $this->cell;
    }

    public function setCell(string $cell): self
    {
        $this->cell = $cell;

        return $this;
    }

    public function getPicture(): ?Picture
    {
        return $this->picture;
    }

    public function setPicture(?Picture $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getNat(): ?string
    {
        return $this->nat;
    }

    public function setNat(string $nat): self
    {
        $this->nat = $nat;

        return $this;
    }

    public function getId(): ?Id
    {
        return $this->Id;
    }

    public function setId(?Id $Id): self
    {
        $this->Id = $Id;

        return $this;
    }

    public static function calculatePassStrength(String $password){

        $spec ="\.\*\?\+\[\]\(\)\{\}\^\$\'&@%é#à()°\/-=µ;:%àç£<>,~èê¤";
        $condition = array();
        $condition[] = ["1","/(?=.*\d)^\d{1,}$/"];
        $condition[] = ["2","/(?=.*[a-zA-Z])^[a-zA-Z]{1,}$/"];
        $condition[] = ["3","/(?=.*[a-zA-Z])(?=.*\d)^[a-zA-Z\d]{2,}$/"];
        $condition[] = ["4","/(?=.*[a-z])(?=.*[A-Z])^[a-zA-Z]{2,}$/"];
        $condition[] = ["5","/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)^[a-zA-Z\d]{3,}$/"];
        $condition[] = ["6","/(?=.*[^a-zA-Z\d])^[^a-zA-Z\d]{1,}$/"];
        $condition[] = ["7","/(?=.*['.$spec.'])(?=.*[a-zA-Z\d])^['.$spec.'a-zA-Z\d]{2,}$/"];
        $condition[]= ["8","/(?=.*['.$spec.'])(?=.*[a-zA-Z])(?=.*[\d])^['.$spec.'a-zA-Z\d]{3,}$/"];
        $condition[]= ["9","/(?=.*['.$spec.'])(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])^['.$spec.'a-zA-Z\d]{4,}$/"];
        $pass = 0;

        for($i=0;$i<count($condition);$i++)
            if(preg_match($condition[$i][1], $password)){
                $pass = $condition[$i][0];
            } 
        return $pass;
    }

    public static function getSearch($userR,$params){
        $joins = ['name','location','login','dob','registered','picture'];
        $qb = $userR->createQueryBuilder('user');

        foreach($joins as $join){
            $qb->join('user.'.$join,$join);
            $qb->addSelect($joins);
        } 

        $keys = array_keys($params);

        foreach($keys as $key){
            $col = '';
            $atts = explode("_",$key);

            for($i = 0;$i < count($atts);$i++){
                if($i == count($atts)-1){
                    $col = $col.$atts[$i];  
                }
                else{
                    $col = $col.$atts[$i].'.';
                }
            } 
            $qb->where($col.' = ?1')
            ->setParameter(1,$params[$key]);
        }

        $val = $qb->getQuery()->getResult(); 
        return $val;
    }  
}
