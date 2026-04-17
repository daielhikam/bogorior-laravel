<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    /**
     * Subscribe email to newsletter
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(Request $request)
    {
        try {
            // Validation rules
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:100',
                'nama' => 'nullable|string|max:100',
            ]);

            if ($validator->fails()) {
                return $this->validationError($validator->errors(), 'Validation failed');
            }

            $validated = $validator->validated();

            // Check if email already exists
            $existing = Subscriber::where('email', $validated['email'])->first();

            if ($existing) {
                if ($existing->status === 'unsubscribe') {
                    // Reactivate subscription
                    $existing->status = 'aktif';
                    $existing->save();
                    
                    return $this->success([
                        'email' => $existing->email,
                        'status' => 'aktif',
                        'message' => 'Berhasil berlangganan kembali!',
                    ], 'Subscription reactivated successfully');
                }
                
                if ($existing->status === 'aktif') {
                    return $this->error('Email sudah terdaftar sebagai subscriber', 409, [
                        'email' => $existing->email,
                        'status' => $existing->status,
                    ]);
                }
            }

            // Create new subscriber
            $subscriber = Subscriber::create([
                'email' => $validated['email'],
                'nama' => $validated['nama'] ?? null,
                'status' => 'aktif',
                'tanggal_subscribe' => now(),
                'token_unsubscribe' => md5($validated['email'] . time()),
            ]);

            // TODO: Send welcome email

            return $this->success([
                'email' => $subscriber->email,
                'status' => 'aktif',
                'message' => 'Berhasil berlangganan newsletter!',
            ], 'Subscription successful', 201);
        } catch (\Exception $e) {
            return $this->error('Failed to subscribe: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Unsubscribe email from newsletter
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unsubscribe(Request $request)
    {
        try {
            $token = $request->input('token');
            $email = $request->input('email');

            if (!$token && !$email) {
                return $this->error('Either token or email is required', 400);
            }

            $query = Subscriber::query();

            if ($token) {
                $query->where('token_unsubscribe', $token);
            } elseif ($email) {
                $query->where('email', $email);
            }

            $subscriber = $query->first();

            if (!$subscriber) {
                return $this->notFound('Subscriber not found');
            }

            if ($subscriber->status === 'unsubscribe') {
                return $this->success([
                    'email' => $subscriber->email,
                    'status' => 'unsubscribe',
                    'message' => 'Email sudah tidak berlangganan.',
                ], 'Already unsubscribed');
            }

            $subscriber->status = 'unsubscribe';
            $subscriber->save();

            return $this->success([
                'email' => $subscriber->email,
                'status' => 'unsubscribe',
                'message' => 'Berhasil berhenti berlangganan newsletter.',
            ], 'Unsubscribe successful');
        } catch (\Exception $e) {
            return $this->error('Failed to unsubscribe: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Verify subscription status
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkStatus(Request $request)
    {
        try {
            $email = $request->input('email');

            if (!$email) {
                return $this->error('Email is required', 400);
            }

            $subscriber = Subscriber::where('email', $email)->first();

            if (!$subscriber) {
                return $this->success([
                    'email' => $email,
                    'is_subscribed' => false,
                    'status' => 'not_registered',
                ], 'Email not registered');
            }

            return $this->success([
                'email' => $subscriber->email,
                'is_subscribed' => $subscriber->status === 'aktif',
                'status' => $subscriber->status,
                'subscribed_at' => $subscriber->tanggal_subscribe ? $subscriber->tanggal_subscribe->toISOString() : null,
            ], 'Subscription status retrieved');
        } catch (\Exception $e) {
            return $this->error('Failed to check status: ' . $e->getMessage(), 500);
        }
    }
}