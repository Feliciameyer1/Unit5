<?php
class DressingRoom {
   public  $NumRooms=3;
   public function __construct($rooms){
          $this->NumRooms=$rooms;   
         }
  
   
   public function RequestRoom($room){
      
         if($this->NumRooms = 0){
           return false;
       } else {
           $this->NumRooms-$room;
           return true;
       }
   }
   public function OpenRoom($room){
       $this->NumRooms+$room;
   }
}
class Customers extends threaded{
    public $NumberOfItems;
    public function __construct($Items){
        
        If($Items=0){
            $Items=mt_rand(1,20);
        }
        $this->NumberOfItems=$Items;
    }
    public function run(){
        $this->synchronized(function($thread){
            $request= ReguestRoom(1);
            if($request!= true){
                $thread->wait();
            } else {
                $thread->notifyOne();
                                
            }
            
            
            
        }, $this);
    }
}
Class Senario{
   public $Numrooms;
   public $NumCustomers;
  public $Customers=[];
  public function microtime(){
      list($usec, $sec) = explode(" ", microtime());
      return ((float)$usec + (float)$sec);
  }
  
    public function __construct($NumRooms,$NumCustomers){
      
         $DressingRoom= New DressingRoom($NumRooms);
        $NumCustomers= new pool($NumCustomers);
        foreach($this->customer as $customer){
            $NumCustomers->submit(new Class($customer) extends Threaded{
                public $NumberOfItems;
                public function __construct($Items){
                    
                    If($Items=0){
                        $Items=mt_rand(1,20);
                    }
                    $this->NumberOfItems=$Items;
                }
                public function run(){
                    $this->synchronized(function($thread){
                        $request= ReguestRoom(1);
                        if($request!= true){
                            $thread->wait();
                        } else {
                            $thread->notifyOne();
                            
                        }
                        
                        
                        
                    }, $this);
                }
            });
        }
      
        
        
    }
  
   
    
   
    public function calculateSenario( $NumCustomers, $items,$NumRooms,$timeaverage,$time){
       
        $CustomersWaiting=$NumCustomers-$NumRooms;
        $waitTime=$time/$CustomersWaiting;
        
        $averageNumItems= $items*$NumCustomers/$NumCustomers;
        
        echo "Begining of senario. Time at start ".$time.",".$NumRooms. " rooms are available.". $NumCustomers." requesting fitting rooms"."<br>" ;
       echo "In this senario there are ".$NumCustomers. "<br>";
       echo "The average number of items is ".$averageNumItems."<br>";
       echo "The average time spent in the room is ". $timeaverage."<br>";
       echo "The average wait time is ". $waitTime."<br>";
    }
   
    
}
function createSenario($senarioNum,$NumRooms,$NumCustomers){
    echo "Senario".$senarioNum. "<br>";
    $time_start= microtime_float();
    $senarioNum= new Senario($NumRooms, $NumCustomers);
    $time_end=microtime_float();
    $time = $time_end-$time_start;
    $timeaverage= $time/$NumCustomers;
    
    calculateSenario($NumCustomers,0,$NumRooms,$timeaverage,$time);
}
createSenario(00, 3, 10);
createSenario(01, 3, 20);
createsenario(02,3,20);
