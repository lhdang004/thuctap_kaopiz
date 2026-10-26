# Project Coding Standards

This file applies to GitHub Copilot in this repository and serves as a template for other projects.
Copy the relevant sections to your project's `.github/copilot-instructions.md`.

## Testing

- Write tests before code (TDD) — follow `test-driven-development` skill
- For bugs: write a failing test first, then fix (Prove-It pattern)
- Test hierarchy: unit > integration > e2e (use the lowest level that captures the behavior)
- Run tests after every change

## Code Quality

- Review across five axes: correctness, readability, architecture, security, performance
- Every commit must pass: lint, type check, tests
- No secrets in code or version control

## Implementation

- Build in small, verifiable increments (incremental-implementation)
- Each increment: implement → test → verify → commit
- Never mix formatting changes with behavior changes
- Feature work: spec → plan → build → verify → review (full lifecycle)

## Security

- Validate and sanitize all user input
- Never trust client-side data
- No secrets, keys, or tokens in source code
- Use parameterized queries — never string-interpolate SQL

## Boundaries

- **Always:** Run tests before commits, validate user input, check for secrets
- **Ask first:** Database schema changes, new dependencies, architectural decisions
- **Never:** Commit secrets, remove failing tests, skip verification

## Language Rules

- Read and analyze source code, file names, technical documentation, error messages, logs, and project instructions in their original language.
- Use English internally for technical analysis and reasoning when appropriate.
- Always respond to the user in Vietnamese.
- Write explanations, summaries, implementation plans, code review comments, and test reports in Vietnamese.
- Keep programming language keywords, API names, framework terminology, commands, identifiers, and error messages unchanged when necessary for technical accuracy.
- Write code comments and documentation in English unless the user explicitly requests Vietnamese.
- Write user-facing application text in the language specified by the project requirements.
- Do not translate source code identifiers, filenames, API endpoints, database column names, or existing technical conventions unnecessarily.
- If the user explicitly requests another response language, follow that request for the current task.
