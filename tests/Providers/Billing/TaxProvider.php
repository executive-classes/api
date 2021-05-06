<?php

namespace Tests\Providers\Billing;

use App\Enums\Billing\StateEnum;
use Closure;

trait TaxProvider
{
    public function getValidCnpj()
    {
        return [
            [ '16254776000178', '16.254.776/0001-78' ]
        ];
    }
    
    public function getInvalidCnpj()
    {
        return [
            [ '11222333444455', '11.222.333/4444-55' ]
        ];
    }

    public function getValidCpf()
    {
        return [
            [ '22404056000', '224.040.560-00' ]
        ];
    }

    public function getInvalidCpf()
    {
        return [
            [ '11122233344', '111.222.333-44' ]
        ];
    }

    public function getValidRg()
    {
        return [
            [ '214888769', '21.488.876-9' ]
        ];
    }

    public function getInvalidRg()
    {
        return [
            [ '112223334', '11.222.333-4' ]
        ];
    }

    public function getValidRgs()
    {
        return [
            'without-x' => [ '214888769', '21.488.876-9' ],
            'with-x' => [ '26311529x', '26.311.529-x' ]
        ];
    }

    public function getInvalidRgs()
    {
        return [
            'without-x' => [ '112223334', '11.222.333-4' ],
            'with-x' => [ '11222333x', '11.222.333-x' ]
        ];
    }

    public function getValidIe()
    {
        return [
            [ StateEnum::SP(), '729213667441', '729.213.667.441' ]
        ];
    }

    public function getInvalidIe()
    {
        return [
            [ StateEnum::SP(), '111222333444', '111.222.333.444' ]
        ];
    }

    public function getValidIes()
    {
        return [
            'acre' => [ StateEnum::AC(), '0113834280122', '01.138.342/801-22' ],
            'alagoas' => [ StateEnum::AL(), '248616536', '248616536' ],
            'amapa' => [ StateEnum::AP(), '036677868', '036677868' ],
            'amazonas' => [ StateEnum::AM(), '123332761', '12.333.276-1' ],
            'bahia' => [ StateEnum::BA(), '96919640', '969196-40' ],
            'ceara' => [ StateEnum::CE(), '781604842', '78160484-2' ],
            'distrito-federal' => [ StateEnum::DF(), '0759389500121', '07593895001-21' ],
            'espirito-santo' => [ StateEnum::ES(), '123729980', '12372998-0' ],
            'goias' => [ StateEnum::GO(), '153763809', '15.376.380-9' ],
            'maranhao' => [ StateEnum::MA(), '120373459', '12037345-9' ],
            'mato-grosso' => [ StateEnum::MT(), '91222256870', '9122225687-0' ],
            'minas-gerais' => [ StateEnum::MG(), '8276202336778', '827.620.233/6778' ],
            'para' => [ StateEnum::PA(), '153660732', '15-366073-2' ],
            'paraiba' => [ StateEnum::PB(), '950532347', '95053234-7' ],
            'parana' => [ StateEnum::PR(), '1877560496', '187.75604-96' ],
            'pernambuco' => [ StateEnum::PE(), '254318622', '2543186-22' ],
            'piaui' => [ StateEnum::PI(), '608773220', '60877322-0' ],
            'rio-de-janeiro' => [ StateEnum::RJ(), '59405926', '59.405.92-6' ],
            'rio-grande-do-norte' => [ StateEnum::RN(), '208348859', '20.834.885-9' ],
            'rio-grande-do-sul' => [ StateEnum::RS(), '9918722504', '991/8722504' ],
            'rondonia' => [ StateEnum::RO(), '61005783988412', '6100578398841-2' ],
            'roraima' => [ StateEnum::RR(), '247543017', '24754301-7' ],
            'sao-paulo' => [ StateEnum::SP(), '729213667441', '729.213.667.441' ],
            'santa-catarina' => [ StateEnum::SC(), '701860472', '701.860.472' ],
            'sergipe' => [ StateEnum::SE(), '067227155', '06722715-5' ],
            'tocantins' => [ StateEnum::TO(), '09032076220', '0903207622-0' ],
        ];
    }

    public function getInvalidIes()
    {
        return [
            'acre' => [ StateEnum::AC(), '1122233344455', '11.222.333/444-55' ],
            'alagoas' => [ StateEnum::AL(), '111111111', '111111111' ],
            'amapa' => [ StateEnum::AP(), '111111111', '111111111' ],
            'amazonas' => [ StateEnum::AM(), '112223334', '11.222.333-4' ],
            'bahia' => [ StateEnum::BA(), '11111122', '111111-22' ],
            'ceara' => [ StateEnum::CE(), '111111112', '11111111-2' ],
            'distrito-federal' => [ StateEnum::DF(), '1111111111122', '11111111111-22' ],
            'espirito-santo' => [ StateEnum::ES(), '111111112', '11111111-2' ],
            'goias' => [ StateEnum::GO(), '112223334', '11.222.333-4' ],
            'maranhao' => [ StateEnum::MA(), '111111118', '11111111-2' ],
            'mato-grosso' => [ StateEnum::MT(), '11111111112', '1111111111-2' ],
            'minas-gerais' => [ StateEnum::MG(), '1112223334444', '111.222.333/4444' ],
            'para' => [ StateEnum::PA(), '112222223', '11-222222-3' ],
            'paraiba' => [ StateEnum::PB(), '111111112', '11111111-2' ],
            'parana' => [ StateEnum::PR(), '1112222233', '111.22222-33' ],
            'pernambuco' => [ StateEnum::PE(), '111111122', '1111111-22' ],
            'piaui' => [ StateEnum::PI(), '111111112', '11111111-2' ],
            'rio-de-janeiro' => [ StateEnum::RJ(), '11222334', '11.222.33-4' ],
            'rio-grande-do-norte' => [ StateEnum::RN(), '112223334', '11.222.333-4' ],
            'rio-grande-do-sul' => [ StateEnum::RS(), '1112222222', '111/2222222' ],
            'rondonia' => [ StateEnum::RO(), '11111111111113', '1111111111111-3' ],
            'roraima' => [ StateEnum::RR(), '111111112', '11111111-2' ],
            'sao-paulo' => [ StateEnum::SP(), '111222333444', '111.222.333.444' ],
            'santa-catarina' => [ StateEnum::SC(), '111222333', '111.222.333' ],
            'sergipe' => [ StateEnum::SE(), '111111112', '11111111-2' ],
            'tocantins' => [ StateEnum::TO(), '11111111112', '1111111111-2' ],
        ];
    }
    
}