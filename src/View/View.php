<?php declare(strict_types=1);

namespace App\View;

class View {

    public $folder;

    public function __construct($folder = null)
    {
        if ($folder) {
            $this->set_folder($folder);
        }
    }

    public function set_folder($folder): void
    {
        $this->folder = rtrim($folder, '/');
    }

    public function render($suggestions, $variables = array()): string
    {
        $template = $this->find_template($suggestions);
        $output = '';
        if ((bool)$template) {
            $output = $this->render_template($template, $variables);
        }
        return $output;
    }

    public function find_template($suggestions): string
    {
        if ( !is_array( $suggestions ) ) {
            $suggestions = array( $suggestions );
        }
        $suggestions = array_reverse( $suggestions );
        $found = '';
        foreach($suggestions as $suggestion){
            $file = "{$this->folder}/{$suggestion}.php";
            if (file_exists($file)){
                $found = $file;
                break;
            }
        }
        return $found;
    }

    public function render_template( /*$template, $variables*/ ): string
    {
        ob_start();
        foreach (func_get_args()[1] as $key => $value) {
            ${$key} = $value;
        }
        include func_get_args()[0];
        return ob_get_clean();
    }

}
