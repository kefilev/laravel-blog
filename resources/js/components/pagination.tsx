import { Link } from '@inertiajs/react';

export default function Pagination({ links }: { links: { url: string | null; label: string; active: boolean }[] }) {
    const appUrl = process.env.APP_URL || 'http://localhost';  // Fallback to localhost if undefined

    console.log(process.env.APP_URL);

    return (
        <div className="mt-12 flex justify-center space-x-2">
            {links.map((link, index) => {
                const isDisabled = link.url === null;
                const isActive = link.active;

                // Dynamically construct the URL like `http://localhost/blog/page/{page}?`
                const pageNumber = link.url?.match(/page=(\d+)/)?.[1];
                const newUrl = pageNumber ? `${appUrl}/blog/page/${pageNumber}?` : '';

                return (
                    <Link
                        key={index}
                        href={newUrl || ''}
                        className={`px-4 py-2 border rounded-md text-sm transition ${isDisabled
                                ? 'text-gray-400 border-gray-200 cursor-not-allowed'
                                : isActive
                                    ? 'bg-blue-600 text-white border-blue-600'
                                    : 'text-gray-700 border-gray-300 hover:bg-gray-100'
                            }`}
                        disabled={isDisabled}
                    >
                        {/* Laravel uses HTML entities; decode them for nice arrows */}
                        <span dangerouslySetInnerHTML={{ __html: link.label }} />
                    </Link>
                );
            })}
        </div>
    );
}
