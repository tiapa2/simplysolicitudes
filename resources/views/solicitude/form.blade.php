<div class="box box-info padding-1">
    <div class="box-body row">
        
        <div class="form-group col-md-3">
            {{ Form::label('moneda') }}
            {{ Form::select('moneda',['DOP'=>'DOP','USD'=>'USD'] ,$solicitude->moneda, ['class' => 'form-control' . ($errors->has('moneda') ? ' is-invalid' : ''), 'placeholder' => 'Moneda']) }}
            {!! $errors->first('moneda', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('monto') }}
            {{ Form::text('monto', $solicitude->monto, ['class' => 'form-control' . ($errors->has('monto') ? ' is-invalid' : ''), 'placeholder' => 'Monto']) }}
            {!! $errors->first('monto', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('int_anual') }}
            {{ Form::text('int_anual', $solicitude->int_anual, ['class' => 'form-control' . ($errors->has('int_anual') ? ' is-invalid' : ''), 'placeholder' => '%']) }}
            {!! $errors->first('int_anual', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('int_comision') }}
            {{ Form::text('int_comision', $solicitude->int_comision, ['class' => 'form-control' . ($errors->has('int_comision') ? ' is-invalid' : ''), 'placeholder' => '%']) }}
            {!! $errors->first('int_comision', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('cuotas') }}
            {{ Form::text('cuotas', $solicitude->cuotas, ['class' => 'form-control' . ($errors->has('cuotas') ? ' is-invalid' : ''), 'placeholder' => 'Cuotas']) }}
            {!! $errors->first('cuotas', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('periodo') }}
            {{ Form::select('periodo', [ 24 => 'Quincenal', 12 => 'Mensual', 3 => 'Trimestral',2 => 'Semestral'], $solicitude->periodo, ['class' => 'form-control' . ($errors->has('periodo') ? ' is-invalid' : ''), 'placeholder' => 'Periodo']) }}
            {!! $errors->first('periodo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('fecha_inicial') }}
            {{ Form::date('fecha_inicial', $solicitude->fecha_inicial, ['class' => 'form-control' . ($errors->has('fecha_inicial') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Inicial']) }}
            {!! $errors->first('fecha_inicial', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('fecha_final') }}
            {{ Form::date('fecha_final', $solicitude->fecha_final, ['class' => 'form-control' . ($errors->has('fecha_final') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Final']) }}
            {!! $errors->first('fecha_final', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('modalidad') }}
            {{ Form::select('modalidad',['Capital e Interés'=>'Capital e Interés','Interés'=>'Interés'] , $solicitude->modalidad, ['class' => 'form-control' . ($errors->has('modalidad') ? ' is-invalid' : ''), 'placeholder' => 'Modalidad']) }}
            {!! $errors->first('modalidad', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('estado') }}
            {{ Form::select('estado', ['En Curso' => 'En Curso', 'Finalizada' => 'Finalizada'] ,$solicitude->estado, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : '')]) }}
            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('referencia') }}
            {{ Form::text('referencia', $solicitude->referencia, ['class' => 'form-control' . ($errors->has('referencia') ? ' is-invalid' : ''), 'placeholder' => 'ID-00 | 00-00']) }}
            {!! $errors->first('referencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('Dia_de_Pago') }}
            {{ Form::select('diapago',['Día 10' => 'Día 10','Día 20' => 'Día 20'] ,$solicitude->diapago, ['class' => 'form-control' . ($errors->has('diapago') ? ' is-invalid' : '')]) }}
            {!! $errors->first('diapago', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group col-md-3">
            {{ Form::label('cant_inversionistas') }}
            {{ Form::select('cant_inversionistas', ['1' => '1', '2' => '2','3' => '3', '4' => '4','5' => '5', '6' => '6', '7' => '7'] , $solicitude->cant_inversionistas, ['class' => 'form-control' . ($errors->has('cant_inversionistas') ? ' is-invalid' : ''), 'placeholder' => 'Elige']) }}
            {!! $errors->first('cant_inversionistas', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <h5 class="mt-2">Inversionistas</h3>
        <script type="text/javascript">
            let temp2 = document.getElementsByName("cant_inversionistas");
            temp2 = temp2[0];
            temp2.addEventListener('change', (e) => {
                inversionistas(temp2);    
            });
            window.addEventListener('load', (e) => {
                let cantidad = temp2;
                inversionistas(cantidad);
            })

            function inversionistas(temp2){
                const inv_container = document.querySelector('#inv_container');
                
                const div1 = document.createElement("div");
                div1.classList.add("row");
                div1.innerHTML = `
                <div class="form-group col-md-3">
                {{ Form::label('Inversionista_#1') }}
                {{ Form::select('id_inv_1', $cliente , $solicitude->id_inv_1, ['class' => 'form-control' . ($errors->has('id_inv_1') ? ' is-invalid' : ''), 'placeholder' => 'Id Inv 1']) }}
                {!! $errors->first('id_inv_1', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group col-md-3">
                {{ Form::label('Monto_Inversionista_#1') }}
                {{ Form::text('monto_inv_1', $solicitude->monto_inv_1, ['class' => 'form-control montoinv' . ($errors->has('monto_inv_1') ? ' is-invalid' : ''), 'placeholder' => 'monto Inv 1']) }}
                {!! $errors->first('monto_inv_1', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                `;
                const div2 = document.createElement("div");
                div2.classList.add("row");
                div2.innerHTML = `
                <div class="form-group col-md-3">
                {{ Form::label('Inversionista_#2') }}
                {{ Form::select('id_inv_2', $cliente , $solicitude->id_inv_2, ['class' => 'form-control' . ($errors->has('id_inv_2') ? ' is-invalid' : ''), 'placeholder' => 'Id Inv 2']) }}
                {!! $errors->first('id_inv_2', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group col-md-3">
                {{ Form::label('Monto_Inversionista_#2') }}
                {{ Form::text('monto_inv_2', $solicitude->monto_inv_2, ['class' => 'form-control montoinv' . ($errors->has('monto_inv_2') ? ' is-invalid' : ''), 'placeholder' => 'monto Inv 2']) }}
                {!! $errors->first('monto_inv_2', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                `;
                const div3 = document.createElement("div");
                div3.classList.add("row");
                div3.innerHTML = `
                <div class="form-group col-md-3">
                {{ Form::label('Inversionista_#3') }}
                {{ Form::select('id_inv_3', $cliente , $solicitude->id_inv_3, ['class' => 'form-control' . ($errors->has('id_inv_3') ? ' is-invalid' : ''), 'placeholder' => 'Id Inv 3']) }}
                {!! $errors->first('id_inv_3', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group col-md-3">
                {{ Form::label('Monto_Inversionista_#3') }}
                {{ Form::text('monto_inv_3', $solicitude->monto_inv_3, ['class' => 'form-control montoinv' . ($errors->has('monto_inv_3') ? ' is-invalid' : ''), 'placeholder' => 'monto Inv 3']) }}
                {!! $errors->first('monto_inv_3', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                `;
                const div4 = document.createElement("div");
                div4.classList.add("row");
                div4.innerHTML = `
                <div class="form-group col-md-3">
                {{ Form::label('Inversionista_#4') }}
                {{ Form::select('id_inv_4', $cliente , $solicitude->id_inv_4, ['class' => 'form-control' . ($errors->has('id_inv_4') ? ' is-invalid' : ''), 'placeholder' => 'Id Inv 4']) }}
                {!! $errors->first('id_inv_4', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group col-md-3">
                {{ Form::label('Monto_Inversionista_#4') }}
                {{ Form::text('monto_inv_4', $solicitude->monto_inv_4, ['class' => 'form-control montoinv' . ($errors->has('monto_inv_4') ? ' is-invalid' : ''), 'placeholder' => 'monto Inv 4']) }}
                {!! $errors->first('monto_inv_4', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                `;
                const div5 = document.createElement("div");
                div5.classList.add("row");
                div5.innerHTML = `
                <div class="form-group col-md-3">
                {{ Form::label('Inversionista_#5') }}
                {{ Form::select('id_inv_5', $cliente , $solicitude->id_inv_5, ['class' => 'form-control' . ($errors->has('id_inv_5') ? ' is-invalid' : ''), 'placeholder' => 'Id Inv 5']) }}
                {!! $errors->first('id_inv_5', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group col-md-3">
                {{ Form::label('Monto_Inversionista_#5') }}
                {{ Form::text('monto_inv_5', $solicitude->monto_inv_5, ['class' => 'form-control montoinv' . ($errors->has('monto_inv_5') ? ' is-invalid' : ''), 'placeholder' => 'monto Inv 5']) }}
                {!! $errors->first('monto_inv_5', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                `;
                const div6 = document.createElement("div");
                div6.classList.add("row");
                div6.innerHTML = `
                <div class="form-group col-md-3">
                {{ Form::label('Inversionista_#6') }}
                {{ Form::select('id_inv_6', $cliente , $solicitude->id_inv_6, ['class' => 'form-control' . ($errors->has('id_inv_6') ? ' is-invalid' : ''), 'placeholder' => 'Id Inv 6']) }}
                {!! $errors->first('id_inv_6', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group col-md-3">
                {{ Form::label('Monto_Inversionista_#6') }}
                {{ Form::text('monto_inv_6', $solicitude->monto_inv_6, ['class' => 'form-control montoinv' . ($errors->has('monto_inv_6') ? ' is-invalid' : ''), 'placeholder' => 'monto Inv 6']) }}
                {!! $errors->first('monto_inv_6', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                `;
                const div7 = document.createElement("div");
                div7.classList.add("row");
                div7.innerHTML = `
                <div class="form-group col-md-3">
                {{ Form::label('Inversionista_#7') }}
                {{ Form::select('id_inv_7', $cliente , $solicitude->id_inv_7, ['class' => 'form-control' . ($errors->has('id_inv_7') ? ' is-invalid' : ''), 'placeholder' => 'Id Inv 7']) }}
                {!! $errors->first('id_inv_7', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group col-md-3">
                {{ Form::label('Monto_Inversionista_#7') }}
                {{ Form::text('monto_inv_7', $solicitude->monto_inv_7, ['class' => 'form-control montoinv' . ($errors->has('monto_inv_7') ? ' is-invalid' : ''), 'placeholder' => 'monto Inv 7']) }}
                {!! $errors->first('monto_inv_7', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                `;
                
                if(temp2.value == 1){
                    inv_container.innerHTML = '';
                    inv_container.append(div1);
                }else if(temp2.value == 2){
                    inv_container.innerHTML = '';
                    inv_container.append(div1,div2);
                }else if(temp2.value == 3){
                    inv_container.innerHTML = '';
                    inv_container.append(div1,div2,div3);
                }else if(temp2.value == 4){
                    inv_container.innerHTML = '';
                    inv_container.append(div1,div2,div3,div4);
                }else if(temp2.value == 5){
                    inv_container.innerHTML = '';
                    inv_container.append(div1,div2,div3,div4,div5);
                }else if(temp2.value == 6){
                    inv_container.innerHTML = '';
                    inv_container.append(div1,div2,div3,div4,div5,div6);
                }else{
                    inv_container.innerHTML = '';
                    inv_container.append(div1,div2,div3,div4,div5,div6,div7);
                }

            }
        </script>
        <div id="inv_container" class="row">
            
        </div>
    </div>
</div>
