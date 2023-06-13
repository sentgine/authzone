<?php

namespace Sentgine\Authzone\Tests\Unit;

class CheckifComponentsExistTest extends BaseClassUnitTest
{
    private $namespace = 'Sentgine\Authzone\View\Components';

    /**
     * Check if the alert component exists.
     * 
     * @return void
     */
    public function test_alert_component_exists(): void
    {
        $this->is_class_exists($this->namespace . '\Alert');
    }

    /**
     * Check if the back button component exists.
     * 
     * @return void
     */
    public function test_back_button_component_exists(): void
    {
        $this->is_class_exists($this->namespace . '\BackButton');
    }

    /**
     * Check if the create button component exists.
     * 
     * @return void
     */
    public function test_create_button_component_exists(): void
    {
        $this->is_class_exists($this->namespace . '\CreateButton');
    }

    /**
     * Check if the update button component exists.
     * 
     * @return void
     */
    public function test_update_button_component_exists(): void
    {
        $this->is_class_exists($this->namespace . '\UpdateButton');
    }

    /**
     * Check if the delete button component exists.
     * 
     * @return void
     */
    public function test_delete_button_component_exists(): void
    {
        $this->is_class_exists($this->namespace . '\DeleteButton');
    }

    /**
     * Check if the modal close button component exists.
     * 
     * @return void
     */
    public function test_modal_close_button_component_exists(): void
    {
        $this->is_class_exists($this->namespace . '\ModalCloseButton');
    }

    /**
     * Check if the save button component exists.
     * 
     * @return void
     */
    public function test_save_button_component_exists(): void
    {
        $this->is_class_exists($this->namespace . '\SaveButton');
    }

    /**
     * Check if the form container component exists.
     * 
     * @return void
     */
    public function test_form_container_component_exists(): void
    {
        $this->is_class_exists($this->namespace . '\FormContainer');
    }

    /**
     * Check if the heading component exists.
     * 
     * @return void
     */
    public function test_heading_component_exists(): void
    {
        $this->is_class_exists($this->namespace . '\Heading');
    }

    /**
     * Check if the heading simple component exists.
     * 
     * @return void
     */
    public function test_heading_simple_component_exists(): void
    {
        $this->is_class_exists($this->namespace . '\HeadingSimple');
    }

    /**
     * Check if the input component exists.
     * 
     * @return void
     */
    public function test_input_component_exists(): void
    {
        $this->is_class_exists($this->namespace . '\Input');
    }

    /**
     * Check if the modal component exists.
     * 
     * @return void
     */
    public function test_modal_component_exists(): void
    {
        $this->is_class_exists($this->namespace . '\Modal');
    }

    /**
     * Check if the search component exists.
     * 
     * @return void
     */
    public function test_search_component_exists(): void
    {
        $this->is_class_exists($this->namespace . '\Search');
    }

    /**
     * Check if the table component exists.
     * 
     * @return void
     */
    public function test_table_component_exists(): void
    {
        $this->is_class_exists($this->namespace . '\Table');
    }

    /**
     * Check if the table data component exists.
     * 
     * @return void
     */
    public function test_table_data_component_exists(): void
    {
        $this->is_class_exists($this->namespace . '\TableData');
    }

    /**
     * Check if the table row component exists.
     * 
     * @return void
     */
    public function test_table_row_component_exists(): void
    {
        $this->is_class_exists($this->namespace . '\TableRow');
    }
}
