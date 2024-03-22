    <?php

    namespace Validators;

    use Src\Validator\AbstractValidator;

    class DateValidator extends AbstractValidator
    {

    protected string $message = 'Field :field cant be bigger than today';

    public function rule(): bool
    {
        $date = strtotime($this->value);
        if ($date === false) {
            return false;
        }

        $today = strtotime(date('Y-m-d'));
        return $date <= $today;
    }
    }
