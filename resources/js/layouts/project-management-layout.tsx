import type { ReactNode } from 'react';
import { home } from '@/routes';

export default function ProjectManagementLayout({
    children,
}: {
    children: ReactNode;
}) {
    return (
        <div className="min-h-svh bg-background">
            <header className="border-b">
                <div className="mx-auto flex min-h-16 max-w-7xl items-center px-4 sm:px-6 lg:px-8">
                    <a
                        href={home.url()}
                        className="inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium transition-colors hover:bg-muted"
                    >
                        ← Back to Portfolio
                    </a>
                </div>
            </header>
            <main className="mx-auto max-w-7xl p-4 sm:px-6 lg:px-8">
                {children}
            </main>
        </div>
    );
}
