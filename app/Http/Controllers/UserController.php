<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\ManageUser;
use Illuminate\Http\Request;
use App\Models\ManageRole;

class UserController extends Controller
{
    /**
     *  list user page
     *
     * @return view
     */

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $option = $request->input('option');
        $users = ManageUser::getListUserForSearch($option,$keyword);

        $roles = ManageRole::pluck('role_name', 'id');
        return view('user.index')->with('users', $users)->with('roles', $roles)->with('keyword',$keyword)->with('option',$option);
    }

    /**
     *  create new user page
     *
     * @return view
     */
    public function add()
    {
        $roles = ManageRole::pluck('role_name', 'id');
        return view('user.add')->with('roles', $roles);
    }

    /**
     *  confirm create user page
     *
     * @return view
     */
    public function confirm(UserCreateRequest $request)
    {
        $inputs = $request->only(
            'manage_role_id','user_last_name','user_first_name','email','password','email_confirmation','password_confirmation'
        );
        \Session::flashInput($inputs);
        $roles = ManageRole::pluck('role_name', 'id');
        return view('user.confirm')->with('inputs', $inputs)->with('roles', $roles);
    }

    /**
     *  complete create user
     *
     * @return view
     */

    public function complete(Request $request)
    {
        $inputs = $request->only(
            'manage_role_id','user_last_name','user_first_name','email','password'
        );
        ManageUser::create($inputs);
        $msg = iniGetMessage('MSG_INPUT_RESULT_04', array( $inputs['email'], 'ユーザー' ));
        return redirect(route('listUser'))->with('message', $msg);
    }

    /**
     *  edit user page
     *
     * @return view
     */
    public function edit(Request $request)
    {
        $userId = $request->input('manage_user_id');
        $oldInputs = \Input::old();
        if( is_null( $userId ) && array_key_exists( 'id', $oldInputs) ){
            $userId = $oldInputs['id'];
        }
        if( is_null( $userId ) ) {
            abort(404);
        }
        $user = ManageUser::where('id', $userId)->first();
        $roles = ManageRole::pluck('role_name', 'id');
        return view('user.edit')->with('roles', $roles)->with('user', $user);
    }

    /**
     *  confirm edit user page
     *
     * @return view
     */
    public function editConfirm(UserEditRequest $request)
    {
        $inputs = $request->only(
            'id', 'manage_role_id','user_last_name','user_first_name','email','password','email_confirmation','password_confirmation'
        );
        \Session::flashInput($inputs);
        $roles = ManageRole::pluck('role_name', 'id');
        return view('user.editConfirm')->with('inputs', $inputs)->with('roles', $roles);
    }

    /**
     *  complete edit user
     *
     * @return view
     */
    public function editComplete(Request $request)
    {
        $inputs = $request->only(
            'id', 'manage_role_id','user_last_name','user_first_name','email','password'
        );

        $user = ManageUser::find($inputs['id']);
        $user->manage_role_id = $inputs['manage_role_id'];
        $user->user_last_name = $inputs['user_last_name'];
        $user->user_first_name = $inputs['user_first_name'];
        $user->email = $inputs['email'];
        if(!empty($inputs['password'])){
            $user->password = $inputs['password'];
        }
        $user->save();
        $msg = iniGetMessage('MSG_INPUT_RESULT_05', array( $inputs['email'], 'ユーザー' ));
        return redirect(route('listUser'))->with('message', $msg);
    }

    /**
     *  soft delete user page
     *
     * @return view
     */
    public function delete(Request $request)
    {
        $inputs = $request->only(
            'manage_user_id'
        );
        $userId = $inputs['manage_user_id'];
        $user = ManageUser::find($userId);

        if (is_null($user)) {
            abort(404);
        }

        // 削除実行
        $user->delete();

        $msg = iniGetMessage('MSG_INPUT_RESULT_06', array($user->email, 'ユーザー' ));

        // 一覧ページに遷移
        return redirect(route('listUser'))->with('message', $msg);
    }

    public function export(Request $request)
    {
        $keyword = $request->input('keyword');
        $option = $request->input('option');
        $data = ManageUser::queryToExport($option,$keyword);

        header('Content-type: application/csv; charset=SJIS');
        header('Content-Disposition: attachment; filename="listUser.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $file = fopen('php://output', 'w');
        $title = array(
            ' ID ',
            ' ロール ',
            ' メールアドレス ',
            '氏名(氏) ',
            '氏名(名) '
        );
        $title = mb_convert_encoding($title, "SJIS", "UTF-8");
        fputcsv($file, $title);
        foreach ($data as $row)
        {
            $row = mb_convert_encoding($row, "SJIS", "UTF-8");
            fputcsv($file, $row);
        }
        exit();

    }
}
