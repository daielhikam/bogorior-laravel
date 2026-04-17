<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Get all team members
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        try {
            $limit = $request->input('limit', 100);
            $aktif = $request->input('aktif', 1);

            $query = Team::query();

            if ($aktif !== null && $aktif !== 'all') {
                $query->where('aktif', (bool) $aktif);
            }

            $query->orderBy('urutan', 'asc')
                ->orderBy('created_at', 'asc');

            if ($limit && $limit > 0) {
                $query->limit($limit);
            }

            $teams = $query->get();

            $formattedTeams = $teams->map(function ($team) {
                return $this->formatTeam($team);
            });

            return $this->success($formattedTeams, 'Team members retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve team members: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get team member by ID
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getById(Request $request)
    {
        try {
            $id = $request->input('id');

            if (!$id) {
                return $this->error('Team ID is required', 400);
            }

            $team = Team::find($id);

            if (!$team) {
                return $this->notFound('Team member not found');
            }

            return $this->success($this->formatTeam($team, true), 'Team member retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve team member: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Get team members by position
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByPosition(Request $request)
    {
        try {
            $position = $request->input('posisi');

            if (!$position) {
                return $this->error('Position is required', 400);
            }

            $teams = Team::where('aktif', true)
                ->where('posisi', 'like', "%{$position}%")
                ->orderBy('urutan', 'asc')
                ->get();

            $formattedTeams = $teams->map(function ($team) {
                return $this->formatTeam($team);
            });

            return $this->success($formattedTeams, "Team members for position '{$position}' retrieved successfully");
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve team members: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Format team data
     * 
     * @param Team $team
     * @param bool $detailed
     * @return array
     */
    private function formatTeam($team, $detailed = false)
    {
        $data = [
            'id_team' => $team->id_team,
            'nama_lengkap' => $team->nama_lengkap,
            'posisi' => $team->posisi,
            'foto_url' => $team->foto ? asset('uploads/team/' . $team->foto) : null,
            'pengalaman' => $team->pengalaman,
            'email' => $team->email,
            'no_whatsapp' => $team->no_whatsapp,
            'urutan' => $team->urutan,
            'aktif' => (bool) $team->aktif,
        ];

        if ($detailed) {
            $data['bio'] = $team->bio;
            
            // Parse keahlian as array
            if ($team->keahlian) {
                $data['keahlian'] = explode("\n", $team->keahlian);
                $data['keahlian'] = array_map('trim', $data['keahlian']);
                $data['keahlian'] = array_filter($data['keahlian']);
            } else {
                $data['keahlian'] = [];
            }
        }

        return $data;
    }
}