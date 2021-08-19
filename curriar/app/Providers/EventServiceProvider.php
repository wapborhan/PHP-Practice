<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;

use App\Events\AddTicket;
use App\Events\ReplyTicket;
use App\Events\AddStaff;
use App\Listeners\SendAddTicketNotification;
use App\Listeners\SendReplyTicketNotification;
use App\Listeners\SendStaffNotification;

// use App\Events\CreateMission;
// use App\Events\ApproveMission;
// use App\Events\UpdateMission;
// use App\Events\AssignMission;
// use App\Events\MissionAction;
// use App\Events\AddShipment;
// use App\Events\ShipmentAction;
// use App\Events\UpdateShipment;
// use App\Events\AddClient;
// use App\Events\AddCaptain;
// use App\Listeners\SendCreateMissionNotification;
// use App\Listeners\SendApproveMissionNotification;
// use App\Listeners\SendUpdateMissionNotification;
// use App\Listeners\SendAssignMissionNotification;
// use App\Listeners\SendMissionActionNotification;
// use App\Listeners\SendAddShipmenttNotification;
// use App\Listeners\SendShipmentActionNotification;
// use App\Listeners\SendUpdateShipmentNotification;
// use App\Listeners\SendClientNotification;
// use App\Listeners\SendCaptainNotification;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
      
        AddTicket::class => [
            SendAddTicketNotification::class,
        ],
        ReplyTicket::class => [
            SendReplyTicketNotification::class,
        ],
        AddStaff::class => [
            SendStaffNotification::class,
        ],
        
        // CreateMission::class => [
        //     SendCreateMissionNotification::class,
        // ],
        // ApproveMission::class => [
        //     SendApproveMissionNotification::class,
        // ],
        // UpdateMission::class => [
        //     SendUpdateMissionNotification::class,
        // ],
        // AssignMission::class => [
        //     SendAssignMissionNotification::class,
        // ],
        // MissionAction::class => [
        //     SendMissionActionNotification::class,
        // ],

        // AddShipment::class => [
        //     SendAddShipmenttNotification::class,
        // ],
        // ShipmentAction::class => [
        //     SendShipmentActionNotification::class,
        // ],
        // UpdateShipment::class => [
        //     SendUpdateShipmentNotification::class,
        // ],

        // AddClient::class => [
        //     SendClientNotification::class,
        // ],
        // AddCaptain::class => [
        //     SendCaptainNotification::class,
        // ],
  ];

  /**
   * Register any events for your application.
   *
   * @return void
   */
  public function boot()
  {
    parent::boot();
    $this->registerEventsAndListeners();
    //
  }

  protected function registerEventsAndListeners()
  {
    $json_folder = "app/AddonEvenListeners";
    $files = \File::files(base_path($json_folder));
    foreach ($files as $file) {
        try {
            $jsonString = file_get_contents(base_path($json_folder."/".$file->getFilename()));
            $events = json_decode($jsonString, true);
            foreach ($events as $event => $listeners) {
                foreach ($listeners as $listener) {
                    Event::listen($event, $listener);
                }
            }   
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
  }
}
