import { HiOutlineSearch } from 'react-icons/hi';

const SearchBar = () => {
    return (
        <div className="relative">
            <input
                type="text"
                placeholder="Search products..."
                className="w-full rounded-md border border-gray-300 px-4 py-2 pr-10 text-sm focus:border-blue-500 focus:ring-blue-500"
            />
            <HiOutlineSearch size={18} className="absolute top-1/2 right-3 -translate-y-1/2 text-gray-500" />
        </div>
    );
};

export default SearchBar;
