<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use frontend\models\PenggunaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use common\models\RefJenisMakanan;
use common\models\RefSisaMakanan;
use common\models\TaPasien;
use common\models\TaSisaMakanan;

/**
 * PenggunaController implements the CRUD actions for User model.
 */
class PerhitunganSisaMakananController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $daftarPasien = TaPasien::find()->all();
        $refJenisMakanan = RefJenisMakanan::find()->all();
        return $this->render('index', [
            'daftarPasien' => $daftarPasien,
            'refJenisMakanan' => $refJenisMakanan,
        ]);
    }
    public function actionProsesPilih($id_pasien, $id_jenis_makanan)
    {
        $request = Yii::$app->request;
        $model = TaSisaMakanan::find()->where(['id_pasien' => $id_pasien, 'id_jenis_makanan' => $id_jenis_makanan])->one();
        if (!isset($model)) {
            $model = new TaSisaMakanan();
        }
        $model->id_pasien = $id_pasien;
        $model->id_jenis_makanan = $id_jenis_makanan;
        $refSisaMakanan =  ArrayHelper::map(RefSisaMakanan::find()->all(), 'id', 'keterangan');

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => " ",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'refSisaMakanan' => $refSisaMakanan,
                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            } else if ($model->load($request->post())) {

                if ($model->save(false)) {

                    return ['forceClose' => true, 'forceReload' => '#site-perhitungan'];
                    // return [
                    //     'forceReload' => '#site-perhitungan',
                    //     'title' => "Informasi ",
                    //     'content' => "<div class'bg-success'>Pembuatan akun berhasil</div>",
                    //     'footer' => Html::button('Tutup', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"])
                    // ];
                }
            } else {
                return [
                    'title' => " ",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'refSisaMakanan' => $refSisaMakanan,

                    ]),
                    'footer' => Html::button('Tutup', ['class' => 'btn btn-default pull-left', 'data-dismiss' => "modal"]) .
                        Html::button('Simpan', ['class' => 'btn btn-primary', 'type' => "submit"])

                ];
            }
        } else {
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'refSisaMakanan' => $refSisaMakanan,
                ]);
            }
        }
    }
}