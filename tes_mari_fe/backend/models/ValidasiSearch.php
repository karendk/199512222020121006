<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Izin;
use Yii;
use yii\helpers\Url;

/**
 * ValidasiSearch represents the model behind the search form of `backend\models\Izin`.
 */
class ValidasiSearch extends Izin
{
    public $q, $atasan, $pengaju;
    public $tab;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nip_pengaju', 'jenis', 'keperluan', 'jam_mulai', 'jam_selesai', 'tanggal', 'nip_atasan', 'alasan_tolak', 'status'], 'safe'],
            [['q', 'atasan', 'pengaju', 'tab'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */

    public function search($params)
    {
        $query = Izin::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'jam_mulai' => $this->jam_mulai,
            'jam_selesai' => $this->jam_selesai,
            'tanggal' => $this->tanggal,
        ]);

        $query->andFilterWhere(['like', 'nip_pengaju', $this->nip_pengaju])
            ->andFilterWhere(['like', 'jenis', $this->jenis])
            ->andFilterWhere(['like', 'keperluan', $this->keperluan])
            ->andFilterWhere(['like', 'nip_atasan', $this->nip_atasan])
            ->andFilterWhere(['like', 'alasan_tolak', $this->alasan_tolak])
            ->andFilterWhere(['like', 'status', $this->status]);

        $this->filterku($query);

        return $dataProvider;
    }

    public function tabPanel()
    {
        // var_dump(Yii::$app->request->get('DafPenawaranSearch')['jenisStatusPenawaran'] ?? null);die();
        // $classDisetujui=(Yii::$app->request->get('DafPenawaranSearch')['jenisStatusPenawaran'] ?? null) == 'arsip' ? 'btn btn-primary active':'btn btn-default';
        $aktif="btn-primary";
        $nonaktif="btn-default\" style=\"background-color:#ffffff\"";
        if ((!isset(Yii::$app->request->get('ValidasiSearch')['tab'])) || (Yii::$app->request->get('ValidasiSearch')['tab'] ?? null) == '0') {
            $classAktif = $aktif;
        }else{
            $classAktif = $nonaktif;
        }

        $classDisetujui = (Yii::$app->request->get('ValidasiSearch')['tab'] ?? null) == '1' ? $aktif : $nonaktif;
        $classDitolak = (Yii::$app->request->get('ValidasiSearch')['tab'] ?? null) == '2' ? $aktif : $nonaktif;
        // $arsip=Url::current(['DafPenawaranSearch' => [
        //     'jenisStatusPenawaran' =>'arsip'
        // ]]);

        $linkAktif = Url::current(['ValidasiSearch' => [
            'tab' => '0'
        ]]);
        $linkDisetujui = Url::current(['ValidasiSearch' => [
            'tab' => '1'
        ]]);
        $linkDitolak = Url::current(['ValidasiSearch' => [
            'tab' => '2'
        ]]);

        $tab='<div class="text-center"><div class="btn-group btn-group-lg" role="group" aria-label="Large button group">
        <a href="' . $linkAktif . '" class="btn ' . $classAktif . '">Aktif</a>
        <a href="' . $linkDisetujui . '"class="btn ' . $classDisetujui . '">Disetujui</a>
        <a href="' . $linkDitolak . '" class="btn ' . $classDitolak . '">Ditolak</a>
    </div>';

        echo $tab;
    }

    private function filterku($query)
    {
        $query->andFilterWhere([
            'nip_atasan' => Yii::$app->user->identity->nip
        ]);

        if (isset($this->tab)) {
            $query->andFilterWhere([
                '=', 'status', $this->tab
            ]);
        }else{
            $query->andFilterWhere([
                'status' => '0'
            ]);
        }

        if (isset($this->q)) {
            $query->andFilterWhere([
                'or',
                ['like', 'nip_pengaju', $this->q],
                ['like', 'nip_atasan', $this->q],
                ['like', 'keperluan', $this->atasan],
                ['like', 'nip_atasan', $this->atasan],
            ]);
        }
    }
}
