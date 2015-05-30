<?php

namespace app\modules\image;

use app\components\BaseModule;
use Yii;

class ImageModule extends BaseModule
{
    public $defaultThumbnailSize = '80x80';
    public $noImageSrc = 'http://placehold.it/300&text=Image+not+found';
    public $thumbnailsDirectory = 'thumbnail';
    public $useWatermark = 0;
    public $watermarkDirectory = 'watermark';
    public $defaultComponent = 'fs';
    public $components = [
        'fs' => [
            'necessary' => [
                'class' => 'creocoder\flysystem\LocalFilesystem',
                'path' => '@webroot/files',
                'active' => true,
                'srcAdapter' => 'app\modules\image\components\Local',
            ],
            'unnecessary' => [
                'cache' => '',
                'replica' => '',
            ],
        ],
    ];

    public $defaultComponents = [
        'fs' => [
            'necessary' => [
                'class' => 'creocoder\flysystem\LocalFilesystem',
                'path' => '@webroot/files',
                'active' => false,
                'srcAdapter' => 'app\modules\image\components\Local',
            ],
            'unnecessary' => [
                'cache' => '',
                'replica' => '',
            ],
        ],
        'ftpFs' => [
            'necessary' => [
                'class' => 'creocoder\flysystem\FtpFilesystem',
                'host' => 'ftp.example.com',
                'active' => false,
                'srcAdapter' => 'app\modules\image\components\Ftp',
            ],
            'unnecessary' => [
                'port' => '',
                'username' => '',
                'password' => '',
                'ssl' => '',
                'timeout' => '',
                'root' => '',
                'permPrivate' => '',
                'permPublic' => '',
                'passive' => '',
                'transferMode' => '',
                'cache' => '',
                'replica' => '',
            ],
        ],
        'awss3Fs' => [
            'necessary' => [
                'class' => 'creocoder\flysystem\AwsS3Filesystem',
                'key' => 'your-key',
                'secret' => 'your-secret',
                'bucket' => 'your-bucket',
                'active' => false,
                'srcAdapter' => 'app\modules\image\components\Awss3',
            ],
            'unnecessary' => [
                'region' => '',
                'baseUrl' => '',
                'prefix' => '',
                'options' => '',
                'cache' => '',
                'replica' => '',
            ],
        ],
        'sftpFs' => [
            'necessary' => [
                'class' => 'creocoder\flysystem\SftpFilesystem',
                'host' => 'sftp.example.com',
                'username' => 'your-username',
                'password' => 'your-password',
                'active' => false,
                'srcAdapter' => 'app\modules\image\components\Ftp',
            ],
            'unnecessary' => [
                'port' => '',
                'privateKey' => '',
                'timeout' => '',
                'root' => '',
                'permPrivate' => '',
                'permPublic' => '',
                'cache' => '',
                'replica' => '',
            ],
        ],
    ];

    public function getFsComponent()
    {
        return Yii::$app->{$this->defaultComponent};
    }

    public function behaviors()
    {
        return [
            'configurableModule' => [
                'class' => 'app\modules\config\behaviors\ConfigurableModuleBehavior',
                'configurationView' => '@app/modules/image/views/configurable/_config',
                'configurableModel' => 'app\modules\image\models\ConfigConfigurationModel',
            ]
        ];
    }
}
