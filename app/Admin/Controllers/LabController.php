<?php

namespace App\Admin\Controllers;

use App\Models\Lab;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LabController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Lab';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Lab());
        $grid->column('lab_id', __('实验室编号'));
        $grid->column('lab_name', __('实验室名称'));

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
        $show = new Show(Lab::findOrFail($id));
        $show->field('lab_id', __('实验室编号'));
        $show->field('lab_name', __('实验室名称'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Lab());

        $form->text('lab_id', __('实验室编号'));
        $form->text('lab_name', __('实验室名称'));

        return $form;
    }
}



