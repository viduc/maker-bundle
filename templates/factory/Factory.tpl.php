<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

<?= $use_statements; ?>

class <?= $class_name ?> implements FactoryInterface
{
    public function make(array $options): mixed
    {

    }
}
