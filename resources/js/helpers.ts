import { User } from "./types";

export function can(user: User, permission: string): boolean {
    return user.permissions.includes(permission);
}

export function canAny(user: User, permissions: string[]): boolean {
    return permissions.some((permission) => can(user, permission));
}

export function hasRole(user: User, role: string): boolean {
    return user.roles.includes(role);
}

export function hasAnyRole(user: User, roles: string[]): boolean {
    return roles.some((role) => hasRole(user, role));
}