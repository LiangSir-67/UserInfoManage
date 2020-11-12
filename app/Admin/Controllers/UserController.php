<?php

namespace App\Admin\Controllers;

use App\Models\Lab;
use App\Models\UserInfo;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'UserInfo';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserInfo());
        $grid->column('lab_id', __('实验室编号'));
        $grid->column('user_name', __('用户姓名'));
        $grid->column('mobile', __('手机号码'));
        $grid->column('create_at', __('进入时间'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(UserInfo::findOrFail($id));
        $show->field('lab_id', __('实验室编号'));
        $show->field('user_name', __('用户姓名'));
        $show->field('mobile', __('手机号码'));
        $show->field('create_at', __('进入时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new UserInfo());
        $form->text('user_name', __('用户姓名'));
        $form->mobile('mobile', __('手机号码'));
        $form->datetime('create_at', __('进入时间'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
