import { Link } from '@inertiajs/react';
import { PaginationLink } from '@/types/blog';

type PaginationProps = {
  links: PaginationLink[];
};

export default function Pagination({ links }: PaginationProps) {
  const appUrl = process.env.APP_URL || 'http://localhost';

  const currentIndex = links.findIndex((link) => link.active);
  const currentPage = parseInt(links[currentIndex]?.url?.match(/page=(\d+)/)?.[1] || '1');

  // Extract page links (skip "Previous" and "Next")
  const pageLinks = links.filter(link => link.url && !isNaN(parseInt(link.label)));

  // Extract page numbers
  const pages = pageLinks.map(link => parseInt(link.label));

  const visiblePages = new Set<number>();
  const firstPage = pages[0];
  const lastPage = pages[pages.length - 1];

  visiblePages.add(firstPage);
  visiblePages.add(lastPage);

  for (let i = currentPage - 0; i <= currentPage + 0; i++) {
    if (i >= firstPage && i <= lastPage) {
      visiblePages.add(i);
    }
  }

  const finalLinks: (PaginationLink | '...')[] = [];

  let lastPageAdded = 0;

  for (let i = 0; i < links.length; i++) {
    const link = links[i];
    const label = link.label;

    // Always include Previous and Next
    if (label.toLowerCase().includes('previous') || label.toLowerCase().includes('next')) {
      finalLinks.push(link);
      continue;
    }

    const page = parseInt(label);
    if (isNaN(page)) continue;

    if (visiblePages.has(page)) {
      // Add ellipsis if gap between last added and current
      if (lastPageAdded && page - lastPageAdded > 1) {
        finalLinks.push('...');
      }

      finalLinks.push(link);
      lastPageAdded = page;
    }
  }

  return (
    <div className="mt-12 flex justify-center space-x-2">
      {finalLinks.map((link, index) => {
        if (link === '...') {
          return (
            <span
              key={`ellipsis-${index}`}
              className="px-3 py-2 text-gray-400 select-none"
            >
              ...
            </span>
          );
        }

        const isDisabled = link.url === null;
        const isActive = link.active;
        const pageNumber = link.url?.match(/page=(\d+)/)?.[1];
        const newUrl = pageNumber ? `${appUrl}/blog/page/${pageNumber}?` : '';

        return (
          <Link
            key={index}
            href={newUrl || ''}
            className={`px-4 py-2 border rounded-md text-sm transition ${
              isDisabled
                ? 'text-gray-400 border-gray-200 cursor-not-allowed'
                : isActive
                ? 'bg-blue-600 text-white border-blue-600'
                : 'text-gray-400 border-gray-300 hover:bg-gray-100'
            }`}
            disabled={isDisabled}
          >
            <span dangerouslySetInnerHTML={{ __html: link.label }} />
          </Link>
        );
      })}
    </div>
  );
}
