<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ta_sisa_makanan".
 *
 * @property int $id
 * @property int|null $id_pasien
 * @property int|null $id_jenis_makanan
 * @property int|null $id_sisa_makanan
 * @property int|null $id_waktu_makan
 * @property int|null $nilai
 * @property int|null $dikalikan
 */
class TaSisaMakanan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ta_sisa_makanan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['id_sisa_makanan', 'required', 'message' => 'Silahkan Isi Kategori.'],
            [['id_pasien', 'id_jenis_makanan', 'id_sisa_makanan', 'id_waktu_makan', 'nilai', 'dikalikan'], 'integer'],
            ['nilai', 'number', 'max' => 4, 'min' => 0, 'tooBig' => 'Nilai max "4".', 'tooSmall' => 'Nilai min "0"']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pasien' => 'Id Pasien',
            'id_jenis_makanan' => 'Id Jenis Makanan',
            'id_sisa_makanan' => 'Id Sisa Makanan',
            'id_waktu_makan' => 'Id Waktu',
            'nilai' => 'Nilai',
            'dikalikan' => 'Dikalikan',
        ];
    }
    public function getJenisMakanan()
    {
        return $this->hasOne(RefJenisMakanan::className(), ['id' => 'id_jenis_makanan']);
    }
    public function getSisaMakanan()
    {
        $model = RefSisaMakanan::find()->where(['id' => $this->id_sisa_makanan])->one();
        if ($model) {
            return $model;
        }
        return false;
        // return $this->hasOne(RefSisaMakanan::className(), ['id' => 'id_sisa_makanan']);
    }
}