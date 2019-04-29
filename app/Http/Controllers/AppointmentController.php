<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Artist;
use App\Song;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AppointmentController extends Controller {
    public function postAppointment(Request $request) {
        $appointment = new Appointment();
        $appointment->name = $request->input('name');
        $appointment->date = $request->input('date');
        $appointment->sent = $request->input('sent');
        $appointment->voice_alerted = $request->input('voice_alerted');

        $connectedUser = JWTAuth::user();

        $user = User::find($connectedUser->id);

        $appointment->user()->associate($user);

        $appointment->save();

        return response()->json(['appointment' => $appointment], 201);
    }

    public function getAppointments() {
        $appointments = Appointment::with('user')->get();
        $response = ['appointments' => $appointments];
        return response()->json($response, 200);
    }

    public function getAppointment($id) {
        $appointment = Appointment::with('user')->find($id);
        if(!$appointment) {
            return response()->json(['message' => 'Document not found'], 404);
        }
        $response = ['appointment' => $appointment];
        return response()->json($response, 200);
    }

    public function putAppointment(Request $request, $id) {
        $appointment = Appointment::find($id);
        if(!$appointment) {
            return response()->json(['message' => 'Document not found'], 404);
        }
        $appointment->name = $request->input('name');
        $appointment->date = $request->input('date');
        $appointment->sent = $request->input('sent');
        $appointment->voice_alerted = $request->input('voice_alerted');

        if($request->input('user_id')) {
            $userId = $request->input('user_id');

            $user = User::find($userId);

            if($user) {
                $appointment->user()->associate($user);
            }
        }

        $appointment->save();
        return response()->json(['appointment' => $appointment], 200);
    }

    public function deleteAppointment($id) {
        $appointment = Appointment::find($id);
        if(!$appointment) {
            return response()->json(['message' => 'Document not found'], 404);
        }

        $appointment->delete();
        return response()->json(['message' => 'Appointment deleted'], 200);
    }
}