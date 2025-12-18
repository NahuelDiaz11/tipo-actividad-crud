# CRUD Tipo de Actividad

Desarrollado en **Laravel + Inertia.js + Vue 3**, que implementa el ABM (Alta, Baja y Modificación) de la entidad **Tipo de Actividad**.

---

## 📌 Objetivo

Implementar el comportamiento funcional del ABM de la entidad **Tipo de Actividad**, representando los distintos tipos de trabajos válidos dentro del sistema.

---

## 📋 Alcance

La aplicación permite:

- ✅ Dar de alta nuevos tipos de actividad  
- ✅ Modificar registros existentes  
- ✅ Eliminar registros (baja lógica)  
- ✅ Listar únicamente registros activos  
- ✅ Validar datos antes de persistir  

---

## 🗄️ Estructura de la Entidad

Campos principales de la entidad **Tipo de Actividad**:

| Campo | Tipo | Descripción |
|------|-----|-------------|
| id | bigint | Identificador |
| descripcion | string | Descripción del tipo de actividad |
| orden_adicional | integer | Orden jerárquico |
| user_upd | bigint | Usuario que realizó la acción |
| deleted_at | timestamp | Baja lógica |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

---

## ⚙️ Reglas de Negocio Implementadas

- ❌ No se permiten registros duplicados
- ✅ Los campos obligatorios deben informarse al momento del alta
- ✅ Validación de campos vacíos
- ✅ Validaciones centralizadas en FormRequest
- ✅ Mensajes de éxito al crear, modificar o eliminar registros
- ✅ Registros con baja lógica no se muestran en listados activos
- ✅ Confirmación antes de eliminar un registro

---

## 🧠 Arquitectura y Decisiones Técnicas

### Backend
- **Laravel**
- Controlador REST (`TipoActividadController`)
- Validaciones mediante:
  - `StoreTipoActividadRequest`
  - `UpdateTipoActividadRequest`
- Baja lógica mediante `SoftDeletes`

### Frontend
- **Vue 3**
- **Inertia.js**
- Componentes desacoplados:
  - `Index.vue` (vista principal)
  - `Form.vue` (alta y edición)
  - `Table.vue` (listado y acciones)

### Comunicación
- Manejo de estados y errores mediante `useForm`
- Mensajes flash desde backend
- Feedback visual de éxito y error con auto-cierre

---

## 🖥️ Funcionalidades

### Alta
- Validación de campos obligatorios
- Prevención de duplicados
- Mensaje de confirmación al crear

### Modificación
- Precarga de datos
- Validación antes de guardar
- Mensaje de éxito al confirmar

### Baja
- Confirmación previa
- Eliminación lógica
- No visible en listados activos

---

## 🚀 Instalación y Ejecución

```bash

composer install
npm install
npm run dev

cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
