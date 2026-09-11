<?php

use App\Models\Material;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function (User $user, int $id) {
    return (int) $user->id === (int) $id;
});

// Channel privat kelas (notifikasi materi & tugas baru)
Broadcast::channel('class.{classId}', function (User $user, int $classId) {
    if ($user->isGuru()) {
        return true;
    }

    return (int) $user->class_id === (int) $classId;
});

// Channel privat diskusi materi
Broadcast::channel('material.{materialId}', function (User $user, int $materialId) {
    if ($user->isGuru()) {
        return true;
    }

    $material = Material::find($materialId);

    return $material && (int) $user->class_id === (int) $material->class_id;
});
