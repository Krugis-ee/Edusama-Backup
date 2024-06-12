<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;

class StudentImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     *
     */
    public function collection(Collection $rows)
    {
        //
        $user_id = session()->get('loginId');
        $org_id = User::getOrganizationId($user_id);
        $branch_id = User::getBranchId($user_id);

        foreach ($rows as $row) {
            $student = User::where('email', $row['email'])->first();
            if ($student) {

                $student->update([
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'email' => $row['email'],
                    'type' => 1,
                    'organization_id' => $org_id,
                    'branch_id' => $branch_id,
                    'user_role_id'=> 2,

                ]);
            } else {

                User::create([
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'email' => $row['email'],
                    'type' => 1,
                    'organization_id' => $org_id,
                    'branch_id' => $branch_id,
                    'user_role_id'=> 2,
                ]);
            }
        }
    }
}
