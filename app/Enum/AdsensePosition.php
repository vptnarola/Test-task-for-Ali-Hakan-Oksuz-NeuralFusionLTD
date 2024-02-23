<?php

namespace App\Enum;

enum AdsensePosition: string
{
	case PAGE_TOP = 'page_top';
	case PAGE_BOTTOM  = 'page_bottom';
	case PAGE_LEFT_SIDE = 'page_left_side';
	case PAGE_RIGHT_SIDE = 'page_right_side';
	case BEFORE_CONTENT = 'before_content';
	case AFTER_CONTENT = 'after_content';

    public function getLabel(): string
    {
        return match ($this) {
            self::PAGE_TOP => str(self::PAGE_TOP->value)->replace('_', ' ')->title(),
            self::PAGE_BOTTOM => str(self::PAGE_BOTTOM->value)->replace('_', ' ')->title(),
            self::PAGE_LEFT_SIDE => str(self::PAGE_LEFT_SIDE->value)->replace('_', ' ')->title(),
            self::PAGE_RIGHT_SIDE => str(self::PAGE_RIGHT_SIDE->value)->replace('_', ' ')->title(),
            self::BEFORE_CONTENT => str(self::BEFORE_CONTENT->value)->replace('_', ' ')->title(),
            self::AFTER_CONTENT => str(self::AFTER_CONTENT->value)->replace('_', ' ')->title(),
        };
    }

	public static function options(): array
    {
        $cases = static::cases();
        $options = [];
        foreach($cases as $case) {
			$options[] = [
                'value' => $case->value, 
                'label' => str($case->name)->replace('_', ' ')->title(),
            ];
        }
        return $options;
    }
}