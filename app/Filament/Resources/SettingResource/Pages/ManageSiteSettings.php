<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;

class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = SettingResource::class;

    protected static ?string $title = 'إعدادات الموقع';

    protected string $view = 'filament.resources.setting-resource.pages.manage-site-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->getSettingsState());
    }

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            Tabs::make('settingsTabs')->tabs([
                Tab::make('الهوية')->schema([
                    Fieldset::make('الشعار والهوية')->schema([
                        FileUpload::make('site_logo')
                            ->label('شعار الموقع')
                            ->disk('public')
                            ->directory('settings/logo')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->moveFiles(),
                        FileUpload::make('site_favicon')
                            ->label('أيقونة الموقع (Favicon)')
                            ->disk('public')
                            ->directory('settings/favicon')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->moveFiles(),
                        FileUpload::make('logo_footer')
                            ->label('شعار الفوتر')
                            ->disk('public')
                            ->directory('settings/logo')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->moveFiles(),
                    ]),
                ]),

                Tab::make('الأساسيات')->schema([
                    Fieldset::make('معلومات أساسية')->schema([
                        TextInput::make('site_title_ar')->label('عنوان الموقع (AR)')->maxLength(255),
                        TextInput::make('site_title_en')->label('عنوان الموقع (EN)')->maxLength(255),
                    ]),
                ]),

                Tab::make('اكتشف')->schema([
                    Fieldset::make('قسم اكتشف')->schema([
                        TextInput::make('discover_title_ar')->label('عنوان القسم (AR)')->maxLength(255),
                        TextInput::make('discover_title_en')->label('Section Title (EN)')->maxLength(255),
                        Textarea::make('discover_desc_ar')->label('الوصف (AR)')->rows(4),
                        Textarea::make('discover_desc_en')->label('Description (EN)')->rows(4),
                    ]),
                ]),

                Tab::make('العنوان')->schema([
                    Fieldset::make('العناوين')->schema([
                        TextInput::make('address1_ar')->label('العنوان 1 (AR)')->maxLength(255),
                        TextInput::make('address1_en')->label('Address 1 (EN)')->maxLength(255),
                        TextInput::make('address2_ar')->label('العنوان 2 (AR)')->maxLength(255),
                        TextInput::make('address2_en')->label('Address 2 (EN)')->maxLength(255),
                    ]),
                    Fieldset::make('الخريطة (Google Maps Embed)')->schema([
                        Textarea::make('map_iframe_1')->label('تضمين الخريطة 1 (iframe)')->rows(4)->columnSpanFull(),
                        Textarea::make('map_iframe_2')->label('تضمين الخريطة 2 (iframe)')->rows(4)->columnSpanFull(),
                    ])->columns(1),
                ]),

                Tab::make('التواصل')->schema([
                    Fieldset::make('بيانات التواصل')->schema([
                        TextInput::make('phone')->label('الهاتف')->tel()->maxLength(255),
                        TextInput::make('email')->label('البريد الإلكتروني')->email()->maxLength(255),
                    ]),
                ]),

                Tab::make('التواصل الاجتماعي')->schema([
                    Fieldset::make('روابط التواصل')->schema([
                        TextInput::make('snapchat')->label('سناب شات')->url()->maxLength(255),
                        TextInput::make('tiktok')->label('تيك توك')->url()->maxLength(255),
                        TextInput::make('x')->label('إكس (تويتر سابقًا)')->url()->maxLength(255),
                        TextInput::make('instagram')->label('إنستغرام')->url()->maxLength(255),
                        TextInput::make('linkedin')->label('لينكدإن')->url()->maxLength(255),
                    ]),
                ]),

                Tab::make('ميتا')->schema([
                    Fieldset::make('وسوم محركات البحث (Meta)')->schema([
                        TextInput::make('meta_title_ar')->label('عنوان الميتا (AR)')->maxLength(255),
                        TextInput::make('meta_title_en')->label('Meta Title (EN)')->maxLength(255),
                        Textarea::make('meta_description_ar')->label('وصف الميتا (AR)')->rows(3)->columnSpanFull(),
                        Textarea::make('meta_description_en')->label('Meta Description (EN)')->rows(3)->columnSpanFull(),
                        TextInput::make('meta_keywords_ar')->label('كلمات مفتاحية (AR)')->helperText('مفصولة بفواصل')->maxLength(500),
                        TextInput::make('meta_keywords_en')->label('Keywords (EN)')->helperText('Comma separated')->maxLength(500),
                        Select::make('meta_robots')->label('Robots')
                            ->options([
                                'index, follow' => 'index, follow',
                                'index, nofollow' => 'index, nofollow',
                                'noindex, follow' => 'noindex, follow',
                                'noindex, nofollow' => 'noindex, nofollow',
                            ])->native(false),
                        TextInput::make('meta_author')->label('Author')->maxLength(255),
                        TextInput::make('meta_canonical')->label('Canonical URL')->url()->maxLength(255)->columnSpanFull(),
                    ])->columns(2),

                    Fieldset::make('Open Graph (OG)')->schema([
                        TextInput::make('meta_og_title_ar')->label('OG العنوان (AR)')->maxLength(255),
                        TextInput::make('meta_og_title_en')->label('OG Title (EN)')->maxLength(255),
                        Textarea::make('meta_og_description_ar')->label('OG الوصف (AR)')->rows(3),
                        Textarea::make('meta_og_description_en')->label('OG Description (EN)')->rows(3),
                        FileUpload::make('meta_og_image')->label('OG Image')
                            ->image()
                            ->disk('public')
                            ->directory('settings/meta')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->moveFiles(),
                    ])->columns(2),

                    Fieldset::make('Twitter Cards')->schema([
                        TextInput::make('meta_twitter_title_ar')->label('Twitter العنوان (AR)')->maxLength(255),
                        TextInput::make('meta_twitter_title_en')->label('Twitter Title (EN)')->maxLength(255),
                        Textarea::make('meta_twitter_description_ar')->label('Twitter الوصف (AR)')->rows(3),
                        Textarea::make('meta_twitter_description_en')->label('Twitter Description (EN)')->rows(3),
                        FileUpload::make('meta_twitter_image')->label('Twitter Image')
                            ->image()
                            ->disk('public')
                            ->directory('settings/meta')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->moveFiles(),
                    ])->columns(2),
                ]),

                Tab::make('من نحن')->schema([
                    Fieldset::make('نبذة عنا')->schema([
                        TextInput::make('about_title_ar')->label('العنوان (AR)')->maxLength(255),
                        TextInput::make('about_title_en')->label('Title (EN)')->maxLength(255),
                        Textarea::make('about_desc_ar')->label('الوصف (AR)')->rows(5),
                        Textarea::make('about_desc_en')->label('Description (EN)')->rows(5),
                        FileUpload::make('about_attachment')->label('مرفق نبذة عنا')
                            ->disk('public')
                            ->directory('settings/about')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->moveFiles(),
                    ])->columns(2),
                ]),
            ])->columnSpanFull(),
        ])->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('حفظ')
                ->color('primary')
                ->action('saveForm'),
        ];
    }

    public function saveForm(): void
    {
        $state = $this->form->getState();

        // Branding
        $this->saveKey('site_logo', $state['site_logo'] ?? null, isFile: true);
        $this->saveKey('site_favicon', $state['site_favicon'] ?? null, isFile: true);
        $this->saveKey('logo_footer', $state['logo_footer'] ?? null, isFile: true);

        // Basics
        $this->saveKey('site_name', $state['site_name'] ?? '');
        $this->saveKeyTrans('site_title', $state['site_title_en'] ?? '', $state['site_title_ar'] ?? '');
        $this->saveKeyTrans('title', $state['title_en'] ?? '', $state['title_ar'] ?? '');

        // Discover section (single key with translations)
        $this->saveKeyTrans('discover_title', $state['discover_title_en'] ?? '', $state['discover_title_ar'] ?? '');
        $this->saveKeyTrans('discover_desc', $state['discover_desc_en'] ?? '', $state['discover_desc_ar'] ?? '');

        // Address (single keys with translations)
        $this->saveKeyTrans('address1', $state['address1_en'] ?? '', $state['address1_ar'] ?? '');
        $this->saveKeyTrans('address2', $state['address2_en'] ?? '', $state['address2_ar'] ?? '');

        // Maps
        $this->saveKey('map_iframe_1', $state['map_iframe_1'] ?? '');
        $this->saveKey('map_iframe_2', $state['map_iframe_2'] ?? '');

        // Contact
        $this->saveKey('phone', $state['phone'] ?? '');
        $this->saveKey('email', $state['email'] ?? '');

        // Social
        $this->saveKey('snapchat', $state['snapchat'] ?? '');
        $this->saveKey('tiktok', $state['tiktok'] ?? '');
        $this->saveKey('x', $state['x'] ?? '');
        $this->saveKey('instagram', $state['instagram'] ?? '');
        $this->saveKey('linkedin', $state['linkedin'] ?? '');

        // Meta (SEO)
        $this->saveKeyTrans('meta_title', $state['meta_title_en'] ?? '', $state['meta_title_ar'] ?? '');
        $this->saveKeyTrans('meta_description', $state['meta_description_en'] ?? '', $state['meta_description_ar'] ?? '');
        $this->saveKeyTrans('meta_keywords', $state['meta_keywords_en'] ?? '', $state['meta_keywords_ar'] ?? '');
        $this->saveKey('meta_robots', $state['meta_robots'] ?? '');
        $this->saveKey('meta_author', $state['meta_author'] ?? '');
        $this->saveKey('meta_canonical', $state['meta_canonical'] ?? '');

        // Open Graph
        $this->saveKeyTrans('meta_og_title', $state['meta_og_title_en'] ?? '', $state['meta_og_title_ar'] ?? '');
        $this->saveKeyTrans('meta_og_description', $state['meta_og_description_en'] ?? '', $state['meta_og_description_ar'] ?? '');
        $this->saveKey('meta_og_image', $state['meta_og_image'] ?? null, isFile: true);

        // Twitter
        $this->saveKeyTrans('meta_twitter_title', $state['meta_twitter_title_en'] ?? '', $state['meta_twitter_title_ar'] ?? '');
        $this->saveKeyTrans('meta_twitter_description', $state['meta_twitter_description_en'] ?? '', $state['meta_twitter_description_ar'] ?? '');
        $this->saveKey('meta_twitter_image', $state['meta_twitter_image'] ?? null, isFile: true);

        // About Us
        $this->saveKeyTrans('about_title', $state['about_title_en'] ?? '', $state['about_title_ar'] ?? '');
        $this->saveKeyTrans('about_desc', $state['about_desc_en'] ?? '', $state['about_desc_ar'] ?? '');
        $this->saveKey('about_attachment', $state['about_attachment'] ?? null, isFile: true);

        Notification::make()->title('تم حفظ الإعدادات بنجاح')->success()->send();
    }

    protected function saveKey(string $key, ?string $value, bool $isFile = false, bool $arOnly = false, bool $enOnly = false): void
    {
        $value = $value ?? '';

        $data = [
            'value_en' => $value,
            'value_ar' => $value,
        ];

        if ($arOnly) {
            $data['value_en'] = '';
            $data['value_ar'] = $value;
        }
        if ($enOnly) {
            $data['value_en'] = $value;
            $data['value_ar'] = '';
        }

        if ($isFile) {
            // For files/images, store path in value_en and copy to value_ar
            $data['value_en'] = $value;
            $data['value_ar'] = $value;
        }

        Setting::updateOrCreate(['key' => $key], $data);
    }

    protected function saveKeyTrans(string $key, string $en, string $ar): void
    {
        Setting::updateOrCreate(
            ['key' => $key],
            ['value_en' => $en, 'value_ar' => $ar]
        );
    }

    protected function getSettingsState(): array
    {
        return [
            // Branding
            'site_logo' => $this->getSettingValue('site_logo'),
            'site_favicon' => $this->getSettingValue('site_favicon'),
            'logo_footer' => $this->getSettingValue('logo_footer'),

            // Basics
            'site_name' => $this->getSettingValue('site_name'),
            'site_title_ar' => $this->getSettingValue('site_title', ar: true),
            'site_title_en' => $this->getSettingValue('site_title'),
            'title_ar' => $this->getSettingValue('title', ar: true),
            'title_en' => $this->getSettingValue('title'),

            // Discover
            'discover_title_ar' => $this->getSettingValue('discover_title', ar: true),
            'discover_title_en' => $this->getSettingValue('discover_title'),
            'discover_desc_ar' => $this->getSettingValue('discover_desc', ar: true),
            'discover_desc_en' => $this->getSettingValue('discover_desc'),

            // Address
            'address1_ar' => $this->getSettingValue('address1', ar: true),
            'address1_en' => $this->getSettingValue('address1'),
            'address2_ar' => $this->getSettingValue('address2', ar: true),
            'address2_en' => $this->getSettingValue('address2'),

            // Maps
            'map_iframe_1' => $this->getSettingValue('map_iframe_1'),
            'map_iframe_2' => $this->getSettingValue('map_iframe_2'),

            // Contact
            'phone' => $this->getSettingValue('phone'),
            'email' => $this->getSettingValue('email'),

            // Social
            'snapchat' => $this->getSettingValue('snapchat'),
            'tiktok' => $this->getSettingValue('tiktok'),
            'x' => $this->getSettingValue('x'),
            'instagram' => $this->getSettingValue('instagram'),
            'linkedin' => $this->getSettingValue('linkedin'),

            // Meta (SEO)
            'meta_title_ar' => $this->getSettingValue('meta_title', ar: true),
            'meta_title_en' => $this->getSettingValue('meta_title'),
            'meta_description_ar' => $this->getSettingValue('meta_description', ar: true),
            'meta_description_en' => $this->getSettingValue('meta_description'),
            'meta_keywords_ar' => $this->getSettingValue('meta_keywords', ar: true),
            'meta_keywords_en' => $this->getSettingValue('meta_keywords'),
            'meta_robots' => $this->getSettingValue('meta_robots'),
            'meta_author' => $this->getSettingValue('meta_author'),
            'meta_canonical' => $this->getSettingValue('meta_canonical'),

            // Open Graph
            'meta_og_title_ar' => $this->getSettingValue('meta_og_title', ar: true),
            'meta_og_title_en' => $this->getSettingValue('meta_og_title'),
            'meta_og_description_ar' => $this->getSettingValue('meta_og_description', ar: true),
            'meta_og_description_en' => $this->getSettingValue('meta_og_description'),
            'meta_og_image' => $this->getSettingValue('meta_og_image'),

            // Twitter
            'meta_twitter_title_ar' => $this->getSettingValue('meta_twitter_title', ar: true),
            'meta_twitter_title_en' => $this->getSettingValue('meta_twitter_title'),
            'meta_twitter_description_ar' => $this->getSettingValue('meta_twitter_description', ar: true),
            'meta_twitter_description_en' => $this->getSettingValue('meta_twitter_description'),
            'meta_twitter_image' => $this->getSettingValue('meta_twitter_image'),

            // About Us
            'about_title_ar' => $this->getSettingValue('about_title', ar: true),
            'about_title_en' => $this->getSettingValue('about_title'),
            'about_desc_ar' => $this->getSettingValue('about_desc', ar: true),
            'about_desc_en' => $this->getSettingValue('about_desc'),
            'about_attachment' => $this->getSettingValue('about_attachment'),
        ];
    }

    protected function getSettingValue(string $key, bool $ar = false): string
    {
        $column = $ar ? 'value_ar' : 'value_en';
        return (string) (Setting::query()->where('key', $key)->value($column) ?? '');
    }
}
