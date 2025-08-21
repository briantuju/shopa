import { AnimatePresence, motion } from 'motion/react';
import { useState } from 'react';
import { HiXMark } from 'react-icons/hi2';
import { IoMenu } from 'react-icons/io5';
import Logo from './Logo';
import NavMenu from './NavMenu';
import SearchBar from './SearchBar';
import UserActions from './UserActions';

const Header = () => {
    const [mobileOpen, setMobileOpen] = useState(false);

    return (
        <header className="sticky top-0 z-50 w-full bg-white shadow-sm">
            <div className="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                {/* Left - Logo */}
                <Logo />

                {/* Center - Nav (hidden on mobile) */}
                <div className="hidden md:flex">
                    <NavMenu />
                </div>

                {/* Center - Search (hidden on mobile) */}
                <div className="hidden w-1/3 lg:block">
                    <SearchBar />
                </div>

                {/* Right - User Actions */}
                <UserActions />

                {/* Mobile Menu Toggle */}
                <button
                    className="ml-2 inline-flex items-center justify-center rounded-md p-2 text-gray-600 md:hidden"
                    onClick={() => setMobileOpen(!mobileOpen)}
                >
                    {mobileOpen ? <HiXMark size={24} /> : <IoMenu size={24} />}
                </button>
            </div>

            {/* Mobile Menu */}
            <AnimatePresence>
                {mobileOpen && (
                    <motion.div
                        key="mobile-menu"
                        initial={{ height: 0, opacity: 0 }}
                        animate={{ height: 'auto', opacity: 1 }}
                        exit={{ height: 0, opacity: 0 }}
                        transition={{ duration: 0.3, ease: 'easeInOut' }}
                        className="overflow-hidden border-t bg-white px-4 pb-4 md:hidden"
                    >
                        <div className="py-2">
                            <SearchBar />
                        </div>
                        <NavMenu vertical />
                    </motion.div>
                )}
            </AnimatePresence>
        </header>
    );
};

export default Header;
