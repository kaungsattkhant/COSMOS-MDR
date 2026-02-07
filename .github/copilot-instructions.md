### Purpose
This file gives concise, actionable guidance to AI coding agents working in this Laravel codebase so they can be productive immediately.

### Big picture (architecture)
- **Framework:** Laravel (standard structure). Core app logic lives under `app/`.
- **Primary pattern:** Controllers -> Services -> Repositories -> Models. Example flow:
  - Controller: [app/Http/Controllers/Api/Admin/RoleController.php](app/Http/Controllers/Api/Admin/RoleController.php)
  - Service: [app/Services/Admin/Role/RoleService.php](app/Services/Admin/Role/RoleService.php)
  - Repository: [app/Repositories/Role/RoleRepository.php](app/Repositories/Role/RoleRepository.php)
  - Resource output: [app/Http/Resources/Role/RoleResourceList.php](app/Http/Resources/Role/RoleResourceList.php)
- **Interface bindings** are registered in [app/Providers/RepositoryServiceProvider.php](app/Providers/RepositoryServiceProvider.php) (see RoleInterface -> RoleRepository binding).

### Project-specific conventions
- Services live under `app/Services` and are injected into controllers via constructor injection (type-hint the concrete service class).
- Repository classes implement thin data access and are bound to interfaces in `RepositoryServiceProvider`. Prefer using the repository via its interface where available.
- Resource classes (named `*ResourceList`) are used for API responses; use `Resource::collection($items)` for lists.
- Controller action names often use `index`, `show`, and `storeOrUpdate` (note: `storeOrUpdate` is used instead of separate `store`/`update`). Follow existing naming where present.
- Helper functions: use `ResponseMessage()` (defined in [app/Helpers/ResponseHelper.php](app/Helpers/ResponseHelper.php)) for simple JSON responses.

### Key files to inspect for patterns/examples
- Service/repository/controller example chain: [app/Http/Controllers/Api/Admin/RoleController.php](app/Http/Controllers/Api/Admin/RoleController.php)
- Repository bindings: [app/Providers/RepositoryServiceProvider.php](app/Providers/RepositoryServiceProvider.php)
- Shared helpers: [app/Helpers/ResponseHelper.php](app/Helpers/ResponseHelper.php)
- Migrations: `database/migrations/` (schema and incremental change patterns)
- Tests: `tests/` and configuration in `phpunit.xml`.

### Developer workflows (commands)
- Install PHP deps: `composer install` then `composer dump-autoload`.
- Install JS deps & dev server: `npm install` then `npm run dev` (Vite is configured via `vite.config.js`).
- Run migrations: `php artisan migrate` (use `--seed` when appropriate).
- Run tests: `php artisan test` or `vendor/bin/phpunit` (configured by `phpunit.xml`).
- Make a controller (example used earlier): `php artisan make:controller Api/Admin/UserController` (project uses nested controller namespaces).

### Integration points & external deps
- Config for mail, queue, cache, third-party services are in `config/` (inspect `config/services.php` and related files).
- Background jobs use Laravel queues (see `config/queue.php`).

### What an AI agent should do first when changing code
1. Find the controller/service/repository chain for the feature and update all layers consistently.
2. If adding a repository, update `app/Providers/RepositoryServiceProvider.php` to bind its interface.
3. Use existing Resource classes for responses; mimic `RoleResourceList` structure rather than inventing new response shapes.
4. Run `php artisan test` locally (or `vendor/bin/phpunit`) to validate changes.

### Concrete examples to follow
- To return paginated results, follow `RoleRepository::all()` which checks `page` and returns paginator when appropriate: [app/Repositories/Role/RoleRepository.php](app/Repositories/Role/RoleRepository.php)
- To persist within a transaction, follow `RoleService::saveRole()` which wraps repository calls in `DB::transaction`: [app/Services/Admin/Role/RoleService.php](app/Services/Admin/Role/RoleService.php)

### Safety and style
- Preserve method naming and resource shapes used in existing controllers (consistency is more important than renaming).
- Keep changes minimal and follow PSR-12 formatting already present in the code.

### When unsure, inspect these locations first
- Controller examples: [app/Http/Controllers/Api/Admin](app/Http/Controllers/Api/Admin)
- Services: [app/Services](app/Services)
- Repositories: [app/Repositories](app/Repositories)
- Resource classes: [app/Http/Resources](app/Http/Resources)

---
If any section is unclear or you want more examples (e.g., a sample PR with an added feature showing all layers), tell me which feature and I will expand the instructions.
