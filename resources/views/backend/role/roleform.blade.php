
            
          
                <!-- Title Field (Required) -->
                <div class="mb-3">
                    {!! Form::label('Name', 'Name', ['class' => 'form-label']) !!}
                    {!! Form::text('Name', old('Name', $role->name ?? null), ['class' => 'form-control', 'id' => 'Name']) !!}
                    {{-- Error Message --}}
                    @error('Name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slug Field (Required) -->
                <div class="mb-3">
                    {!! Form::label('Slug', 'Slug', ['class' => 'form-label']) !!}
                    {!! Form::text('Slug',old('Slug', $role->slug ?? null), ['class' => 'form-control', 'id' => 'Slug']) !!}
                    {{-- Error Message --}}
                    @error('Slug')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Permissions Field -->
                <div class="mb-3">
                    {!! Form::label('Permission', 'Select Permissions', ['class' => 'form-label']) !!}
                    {!! Form::select('Permission[]', $permissions->pluck('name', 'id')->toArray(),   old('Permission', isset($role) ? $role->permissions->pluck('id')->toArray() : []), ['class' => 'form-control select2', 'id' => 'Permission', 'multiple' => 'multiple']) !!}
                    {{-- Error Message --}}
                    @error('Permission')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
               
            
         

          



