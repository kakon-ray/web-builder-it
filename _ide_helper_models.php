<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\AddCourse
 *
 * @property int $id
 * @property string|null $course_title
 * @property string|null $course_fee
 * @property string|null $course_img
 * @property string|null $desc
 * @method static \Illuminate\Database\Eloquent\Builder|AddCourse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddCourse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddCourse query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddCourse whereCourseFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddCourse whereCourseImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddCourse whereCourseTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddCourse whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddCourse whereId($value)
 */
	class AddCourse extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AddServices
 *
 * @property int $id
 * @property string|null $services_title
 * @property string|null $services_img
 * @property string|null $desc
 * @method static \Illuminate\Database\Eloquent\Builder|AddServices newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddServices newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AddServices query()
 * @method static \Illuminate\Database\Eloquent\Builder|AddServices whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddServices whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddServices whereServicesImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AddServices whereServicesTitle($value)
 */
	class AddServices extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AdmissionModel
 *
 * @property int $id
 * @property string|null $admission_student_name
 * @property string|null $admission_student_father_name
 * @property string|null $admission_student_mother_name
 * @property string|null $admission_student_address
 * @property string|null $admission_student_phonenumber
 * @property string|null $admission_course_fee
 * @property string|null $admission_student_bikash_number
 * @property string|null $admission_student_bikash_tranxid
 * @property string|null $admission_course_name
 * @property string|null $admission_student_email_number
 * @method static \Illuminate\Database\Eloquent\Builder|AdmissionModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdmissionModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdmissionModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdmissionModel whereAdmissionCourseFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdmissionModel whereAdmissionCourseName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdmissionModel whereAdmissionStudentAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdmissionModel whereAdmissionStudentBikashNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdmissionModel whereAdmissionStudentBikashTranxid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdmissionModel whereAdmissionStudentEmailNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdmissionModel whereAdmissionStudentFatherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdmissionModel whereAdmissionStudentMotherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdmissionModel whereAdmissionStudentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdmissionModel whereAdmissionStudentPhonenumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdmissionModel whereId($value)
 */
	class AdmissionModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CourseModel
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $course_name
 * @property string|null $message
 * @method static \Illuminate\Database\Eloquent\Builder|CourseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseModel whereCourseName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseModel whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseModel wherePhone($value)
 */
	class CourseModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GalleryModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GalleryModel query()
 */
	class GalleryModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SeminerModel
 *
 * @property int $id
 * @property string|null $seminer_title
 * @property string|null $seminer_date
 * @property string|null $seminer_time
 * @method static \Illuminate\Database\Eloquent\Builder|SeminerModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SeminerModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SeminerModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|SeminerModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeminerModel whereSeminerDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeminerModel whereSeminerTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeminerModel whereSeminerTitle($value)
 */
	class SeminerModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServicesModel
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $services_name
 * @property string|null $message
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesModel whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesModel wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ServicesModel whereServicesName($value)
 */
	class ServicesModel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $role
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

